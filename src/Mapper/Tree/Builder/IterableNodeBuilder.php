<?php

declare(strict_types=1);

namespace CuyZ\Valinor\Mapper\Tree\Builder;

use CuyZ\Valinor\Mapper\Tree\Node;
use CuyZ\Valinor\Mapper\Tree\Shell;

use function is_array;
use function is_iterable;
use function iterator_to_array;

/** @internal */
final class IterableNodeBuilder implements NodeBuilder
{
    private NodeBuilder $delegate;

    public function __construct(NodeBuilder $delegate)
    {
        $this->delegate = $delegate;
    }

    public function build(Shell $shell, RootNodeBuilder $rootBuilder): Node
    {
        if ($shell->hasValue()) {
            $value = $shell->value();

            if (is_iterable($value) && ! is_array($value)) {
                $shell = $shell->withValue(iterator_to_array($value));
            }
        }

        return $this->delegate->build($shell, $rootBuilder);
    }
}
