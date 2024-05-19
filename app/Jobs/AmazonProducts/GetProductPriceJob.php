<?php

namespace App\Jobs\AmazonProducts;

use AmazonSellingPartner\Model\ProductPricing\OfferType;
use AmazonSellingPartner\Model\ProductPricing\Price;
use AmazonSellingPartner\Model\ProductPricing\Product AS PricingProduct;
use App\AmazonSpClients\PricingApiClient;
use App\Jobs\BaseJob;
use App\Models\Product;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetProductPriceJob extends BaseJob implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/** @var PricingApiClient */
	protected $client;
    protected $chunk_size = 20;

    /**
     * @throws Exception
     */
    public function getPricingClient(): PricingApiClient {
        if (!($this->client instanceof PricingApiClient)) {
            $this->client = new PricingApiClient($this->getUser());
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
            ->chunkById($this->chunk_size, function (Collection $products) {

                $asins_chunk = array_filter($products->pluck('asin')->toArray());

                $price_list = $this->getPricingClient()->getPricing($asins_chunk);

                /** @var Price $price */
                foreach ($price_list as $price) {
                    if ($price->getStatus() !== 'Success') {
                        continue;
                    }

                    /** @var Product $product */
                    $product = $products->where('asin', $price->getAsin())->first() ?? null;
                    if (!$product) {
                        continue;
                    }

                    $this->saveOffersResponse($product, $price);
                }

                $this->setJobActive();
            });
    }

    protected function saveOffersResponse(Product $product, Price $price): void {
        /** @var PricingProduct $pricing_product */
        $pricing_product = $price->getProduct();

        /** @var OfferType $offer */
        foreach ($pricing_product->getOffers() ?? [] as $offer) {
            if ($offer->getSellerSku() != $product->sku) continue;

            $buying_price = $offer->getBuyingPrice();

            $product->listing_price = $buying_price->getListingPrice()->getAmount();

            $product->save();

            console_log('Saved pricing details for: ' . $product->id);

            break;
        }
    }
}
