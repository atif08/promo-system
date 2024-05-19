<?php

namespace App\Jobs\AmazonProducts;

use AmazonSellingPartner\Model\CatalogItem\Item;
use App\AmazonSpClients\CatalogsApiClient;
use App\Jobs\BaseJob;
use App\Models\Product;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetProductCatalogJob extends BaseJob implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var CatalogsApiClient */
    protected $client;
    protected $chunk_size = 20;

    /**
     * @return CatalogsApiClient
     * @throws Exception
     */
    public function getCatalogsClient(): CatalogsApiClient {
        if (!($this->client instanceof CatalogsApiClient)) {
            $this->client = new CatalogsApiClient($this->getUser());
            $this->client->setParentJob($this->parent_job ?: $this);
        }
        return $this->client;
    }

    public function processJob() {
        if (!$this->user->hasSellingPartnerAccess()) {
            console_log('Selling Partner API access denied');
            return;
        }

        Product::query()
            ->where('user_id', $this->user->id)
            ->orderBy('id')
            ->offset(200)
            ->chunkById($this->chunk_size, function (Collection $products) {
                $sku_chunk = $products->pluck('sku')->toArray();
//                dd($sku_chunk);

                $catalog_items = $this->getCatalogsClient()
                    ->searchCatalogItemsBySKUs($sku_chunk);

                /** @var Item $catalog_item */
                foreach ($catalog_items as $catalog_item) {
//                    dd($catalog_item,$catalog_item->getImages()[0]->getImages()[1]->getLink());

                    /** @var Product|NULL $product */
                    $product = NULL;

                    $identifiers = $catalog_item->getIdentifiers()[0]->getIdentifiers();
                    foreach ($identifiers as $identifier) {

                        if ($identifier->getIdentifierType() == 'SKU') {
                            $product = $products->where('sku', $identifier->getIdentifier())->first();
                            break;
                        }
                    }

                    if (!$product) {
                        continue;
                    }

                    if (!$product->parent_asin) {
                        $relationships = $catalog_item->getRelationships()[0]->getRelationships();
                        foreach ($relationships as $relationship) {
                            $parent_asin = $relationship->getParentAsins()[0] ?? null;
                            if ($parent_asin) {
                                $product->parent_asin = $parent_asin;
                                break;
                            }
                        }
                    }

                    /** get image */

//                    if (!$product->image_thumbnail) {
//
//                        $image = $catalog_item->getImages()[0]->getImages()[1]->getLink();
//                        $product->image_thumbnail = $image;
//                    }

                    $product->save();
                    dd($product);


                    console_log('Saved product details for: ' . $product->id);
                }
            });
    }

}
