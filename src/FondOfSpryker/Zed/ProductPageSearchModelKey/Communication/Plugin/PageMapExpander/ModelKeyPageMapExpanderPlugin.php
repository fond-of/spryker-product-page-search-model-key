<?php

namespace FondOfSpryker\Zed\ProductPageSearchModelKey\Communication\Plugin\PageMapExpander;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractMapExpanderPluginInterface;

class ModelKeyPageMapExpanderPlugin extends AbstractPlugin implements ProductAbstractMapExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands and returns the provided PageMapTransfer objects data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandProductMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $productData, LocaleTransfer $localeTransfer): PageMapTransfer
    {
        if (!array_key_exists(PageIndexMap::MODEL_KEY, $productData)) {
            return $pageMapTransfer;
        }

        if (!method_exists($pageMapTransfer, 'setModelKey')) {
            return $pageMapTransfer;
        }

        $this->addModelKeyToPageMapTransfer($pageMapTransfer, $productData);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param array $productData
     *
     * @return void
     */
    protected function addModelKeyToPageMapTransfer(PageMapTransfer $pageMapTransfer, array $productData): void
    {
        $pageMapTransfer->setModelKey($productData[PageIndexMap::MODEL_KEY]);
    }
}
