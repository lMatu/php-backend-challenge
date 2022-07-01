<?php

namespace App;

class VillaPeruana
{
    public $name;

    public $quality;

    public $sellIn;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public function setQuality($quality)
    {
        $this->quality = $quality;
    }

    public function setSellIn($sellIn)
    {
        $this->sellIn = $sellIn;
    }

    public static function of($name, $quality, $sellIn)
    {
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        switch ($this->name) {
            case "normal":
                $this->normalTick();
                break;
            case "Pisco Peruano":
                $this->piscoTick();
                break;
            case "Ticket VIP al concierto de Pick Floid":
                $this->vipTick();
                break;
            case "Café Altocusco":
                $this->cafeTick();
                break;
            case "Tumi de Oro Moche":
            default:
                break;
        }
    }

    public function normalTick()
    {
        $this->removeQuality();
        $this->removeSellIn();

        if ($this->sellIn < 0) {
            $this->removeQuality();
        }
    }
    public function piscoTick()
    {
        $this->addQuality();
        $this->removeSellIn();

        if ($this->sellIn < 0) {
            $this->addQuality();
        }
    }

    public function vipTick()
    {
        if ($this->sellIn <= 0) {
            $this->setQuality(0);
        } else {
            $this->addQuality();
            if ($this->sellIn < 11) {
                $this->addQuality();
                if ($this->sellIn < 6) {
                    $this->addQuality();
                }
            }
        }

        $this->removeSellIn();
    }

    public function cafeTick()
    {
        $this->removeQuality(2);
        $this->removeSellIn();

        if ($this->sellIn < 0) {
            $this->removeQuality(2);
        }
    }

    private function addQuality()
    {
        $this->setQuality($this->quality < 50 ? $this->quality + 1 : $this->quality);
    }

    private function removeQuality($fastDegrade = 1)
    {
        $this->setQuality($this->quality > 0 ? $this->quality - $fastDegrade : 0);
    }

    private function removeSellIn()
    {
        $this->setSellIn($this->sellIn - 1);
    }
}
