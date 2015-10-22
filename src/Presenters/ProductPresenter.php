<?php

namespace Laravel\Shop\Presenters;

use Robbo\Presenter\Presenter;

class ProductPresenter extends Presenter {

    /**
     * Format title .
     *
     * @param null $locale
     * @return mixed
     */
    public function formatTitle($locale = null) {
        if( $translation = $this->getObject()->translate($locale) )
            return $translation->title;
    }
}