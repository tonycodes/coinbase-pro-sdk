<?php


namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;


use MockingMagician\CoinbaseProSdk\Contracts\Build\CommonOrderToPlaceInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Build\PaginationInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\OrdersInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\OrderDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\OrderData;

class Orders extends AbstractRequestManagerAware implements OrdersInterface
{
    public function placeOrderRaw(CommonOrderToPlaceInterface $orderToPlace)
    {
        return $this->getRequestManager()->prepareRequest('POST', '/orders', [], json_encode($orderToPlace->getBodyForRequest()))->signAndSend();
    }

    /**
     * @inheritDoc
     */
    public function placeOrder(CommonOrderToPlaceInterface $orderToPlace): OrderDataInterface
    {
        return OrderData::createFromJson($this->placeOrderRaw($orderToPlace));
    }

    public function cancelOrderByIdRaw(string $orderId, string $productId = null)
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestManager()
            ->prepareRequest('DELETE', sprintf('/orders/%s', $orderId), [], $body ? json_encode($body) : null)
            ->signAndSend()
        ;
    }

    /**
     * @inheritDoc
     */
    public function cancelOrderById(string $orderId, string $productId = null): bool
    {
        return $orderId === json_decode($this->cancelOrderByIdRaw($orderId, $productId), true);
    }

    public function cancelOrderByClientOrderIdRaw(string $clientOrderId, string $productId = null)
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestManager()
            ->prepareRequest('DELETE', sprintf('/orders/client:%s', $clientOrderId), [], $body ? json_encode($body) : null)
            ->signAndSend()
        ;
    }

    public function cancelOrderByClientOrderId(string $clientOrderId, string $productId = null): bool
    {
        $this->cancelOrderByClientOrderIdRaw($clientOrderId, $productId);

        return true; // assume error was not throw equals true
    }

    public function cancelAllOrdersRaw(string $productId = null)
    {
        $body = null;

        if ($productId) {
            $body = ['product_id' => $productId];
        }

        return $this->getRequestManager()
            ->prepareRequest('DELETE', '/orders', [], $body ? json_encode($body) : null)
            ->signAndSend()
        ;
    }

    /**
     * @inheritDoc
     */
    public function cancelAllOrders(string $productId = null): array
    {
        $ids = json_decode($this->cancelAllOrdersRaw($productId), true);

        if (is_array($ids)) {
            return $ids;
        }

        return [];
    }

    /**
     * @inheritDoc
     */
    public function listOrders(array $status = self::STATUS, string $productId = null, PaginationInterface $pagination = null): array
    {
        // TODO: Implement listOrders() method.
    }

    /**
     * @inheritDoc
     */
    public function getOrderById(string $orderId): OrderDataInterface
    {
        // TODO: Implement getOrderById() method.
    }

    public function getOrderByClientOrderId(string $clientOrderId): OrderDataInterface
    {
        // TODO: Implement getOrderByClientOrderId() method.
    }
}
