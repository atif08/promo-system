<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarbonHelper {

    const TODAY          = 'TODAY';
    const YESTERDAY      = 'YESTERDAY';
    const SEVEN_DAYS     = '7_DAYS';
    const THIS_WEEK      = 'THIS_WEEK';
    const LAST_WEEK      = 'LAST_WEEK';
    const THIS_YEAR      = 'THIS_YEAR';

    const INVENTORY_WEEK = 'INVENTORY_WEEK';
    const THIRTY_DAYS    = '30_DAYS';
    const THIS_MONTH     = 'THIS_MONTH';
    const LAST_MONTH     = 'LAST_MONTH';
    const CUSTOM_RANGE   = 'CUSTOM_RANGE';

    /** @var Request */
    private $request;
    /** @var string */
    private $format = 'm-d-Y';
    /** @var Carbon */
    private $from_date;
    /** @var Carbon */
    private $to_date;
    /** @var string */
    private $label = 'Custom Range';

    public function __construct(User $user = null, Request $request = null, $default_days = 13) {
        $this->from_date = Carbon::now()->subDays($default_days);
        $this->to_date   = Carbon::yesterday();

        if ($request) {
            $this->request = $request;

            if ($this->request->has('from_date')) {
                $this->from_date = Carbon::parse($this->request->get('from_date'));
            }

            if ($this->request->has('to_date')) {
                $this->to_date = Carbon::parse($this->request->get('to_date'));
            }

            $label       = $this->request->get('date_range') ?: '';
            $this->label = $label && !is_array($label) ? $label : $this->label;
        }

    }

    public function setFormat($format): self {
        $this->format = $format;
        return $this;
    }

    public function setFromDate(Carbon $from_date): self {
        $this->from_date = $from_date;
        return $this;
    }

    public function getFromDate(): Carbon {
        return $this->from_date;
    }

    public function getFromDays(): int {
        return $this->getFromDate()->diffInDays(Carbon::now()) + 1;
    }

    public function getFromDateString(): string {
        return $this->from_date->copy()->format($this->format);
    }

    public function setToDate($to_date): CarbonHelper {
        $this->to_date = $to_date;
        return $this;
    }

    public function getToDate(): Carbon {
        return $this->to_date;
    }

    public function getToDateString(): string {
        return $this->to_date->copy()->format($this->format);
    }

    public function setLabel($label): self {
        $this->label = $label;
        return $this;
    }

    public function getLabel(): string {
        return $this->label ?: '';
    }

    public function getRange(): array {
        return [
            $this->from_date,
            $this->to_date
        ];
    }

    public function getRangeYmd(): array {
        return [
            $this->from_date->copy()->toDateString(),
            $this->to_date->copy()->toDateString()
        ];
    }

    public function getFullDayRange() {
        return [
            $this->getFromDate()->startOfDay(),
            $this->getToDate()->endOfDay()
        ];
    }

    public function getTotalDays(): int {
        return $this->getFromDate()->diffInDays($this->getToDate()) + 1;
    }

    // for frontend date picker
    public function displayRange() {
        if (!empty($this->label) && $this->label !== 'Custom Range') {
            return $this->label;
        }

        return implode(' - ', [
                $this->getFromDateString(),
                $this->getToDateString()
            ]
        );
    }

    public function getComparisonObject($label = null): CarbonHelper {
        $days  = $this->getTotalDays();
        $label = $label ?? $this->label;

        switch ($label) {
            case self::THIS_WEEK:
            case self::LAST_WEEK:
                $from_date = $this->getFromDate()->copy()->subDay()->startOfWeek(7);
                break;

            case self::THIS_MONTH:
            case self::LAST_MONTH:
                $from_date = $this->getFromDate()->copy()->subDay()->startOfMonth();
                break;

            case self::THIS_YEAR:
                $from_date = $this->getFromDate()->copy()->subDay()->startOfYear();
                break;

            case self::INVENTORY_WEEK:
                return (new self())
                    ->setFromDate($this->getFromDate()->copy())
                    ->setToDate($this->getFromDate()->copy()->endOfWeek(6));

            default:
                $from_date = $this->getFromDate()->copy()->subDays($days);
                break;
        }

        return (new self())
            ->setFromDate($from_date)
            ->setToDate($this->getFromDate()->copy()->subDay()->endOfDay());
    }

    public function getDateHeadersByDay($format_lg = 'm-d-Y', $format_sm = 'm-d-Y') {
        return $this->getDateHeadersByPeriod($format_lg, $format_sm, 'endOfDay');
    }

    public function getDateHeadersByWeek($format_lg = 'm-d-Y', $format_sm = 'm-d-Y') {
        return $this->getDateHeadersByPeriod($format_lg, $format_sm, 'endOfWeek');
    }

    public function getDateHeadersByMonth($format_lg = 'm-d-Y', $format_sm = 'm-d-Y') {
        return $this->getDateHeadersByPeriod($format_lg, $format_sm, 'endOfMonth');
    }

    public function getDateHeadersByQuarter($format_lg = 'm-d-Y', $format_sm = 'm-d-Y') {
        return $this->getDateHeadersByPeriod($format_lg, $format_sm, 'endOfQuarter');
    }

    private function getDateHeadersByPeriod($format_lg = 'm-d-Y', $format_sm = 'm-d-Y', $endOfPeriod = 'endOfDay') {
        $from_date = $this->getFromDate()->copy();
        $to_date   = $this->getToDate()->copy();
        $range     = [];

        $getFormatted = function ($carbon, $format) {
            $method = Str::contains($format, '%') ? 'formatLocalized' : 'format';
            return $carbon->$method($format);
        };

        while ($from_date->lte($to_date)) {
            $_to_date    = $from_date->copy()->$endOfPeriod();
            $comp_object = (self::createFromDate($from_date->copy(), $_to_date))->getComparisonObject();

            $label_sm = $getFormatted($from_date->copy(), $format_sm);

            $from_label = $getFormatted($from_date->copy(), $format_lg);
            $to_label   = $getFormatted($_to_date->copy(), $format_lg);

            $alias = str_replace(['/', ' - '], ['', ''], $from_label . ' - ' . $to_label);

            switch ($endOfPeriod) {
                case 'endOfQuarter':
                    $label_lg = 'Q' . $from_date->quarter . ', ' . $from_date->year;
                    $label_sm = $label_lg;
                    break;
                case 'endOfMonth':
                    $label_lg = $label_sm;
                    break;
                case 'endOfDay':
                    $label_lg = $from_label;
                    break;
                default:
                    $label_lg = $from_label . '<br/>' . $to_label;
                    break;
            }

            $range[$alias] = [
                'label_lg' => $label_lg,
                'label_sm' => $label_sm,
                'current'  => [
                    $from_date->copy()->startOfDay()->toDateTimeString(),
                    $_to_date->copy()->endOfDay()->toDateTimeString()
                ],
                'previous' => [
                    $comp_object->getFromDate()->toDateTimeString(),
                    $comp_object->getToDate()->toDateTimeString()
                ],
            ];

            $from_date->$endOfPeriod()->addDay()->startOfDay();
        }

        return $range;
    }

    public static function createFromDate($from_date, $to_date = null) {
        $from_date = ($from_date instanceof Carbon ? $from_date : Carbon::parse($from_date))->startOfDay();
        $to_date   = (!$to_date ? $from_date->copy() : ($to_date instanceof Carbon ? $to_date : Carbon::parse($to_date)))->endOfDay();

        $object = new self();
        $object->setFromDate($from_date);
        $object->setToDate($to_date);
        return $object;
    }
}
