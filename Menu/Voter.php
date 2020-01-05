<?php

namespace SchoolIT\CommonBundle\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Voter\VoterInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Voter implements VoterInterface {

    private $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritDoc
     */
    public function matchItem(ItemInterface $item): ?bool {
        $currentUri = $this->requestStack->getMasterRequest()->getRequestUri();
        $itemUri = $item->getUri();

        if($itemUri === null) {
            return false;
        }

        if($currentUri === $itemUri) {
            return true;
        }

        if($itemUri === substr($currentUri, 0, strlen($itemUri))) {
            return true;
        }

        return false;
    }
}