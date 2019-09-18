<?php

namespace yiicom\commerce\backend\search;

interface SearchModelInterface
{
    /**
     * Triggered after model prepares query
     */
    const EVENT_AFTER_PREPARE_QUERY = 'afterPrepareQuery';

    /**
     * Triggered after model prepares data provider
     */
    const EVENT_AFTER_PREPARE_DATA_PROVIDER = 'afterPrepareDataProvider';

    /**
     * Triggered after model prepares search filters
     */
    const EVENT_AFTER_PREPARE_FILTERS = 'afterPrepareFilters';

}