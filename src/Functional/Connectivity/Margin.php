<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Functional\Connectivity;

use DateTime;
use DateTimeInterface;
use MockingMagician\CoinbaseProSdk\Contracts\Connectivity\MarginInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\BuyingPowerDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\LiquidationStrategyDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginProfileDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\MarginStatusDataInterface;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\PositionRefreshAmountsData;
use MockingMagician\CoinbaseProSdk\Contracts\DTO\WithdrawalPowerDataInterface;
use MockingMagician\CoinbaseProSdk\Functional\DTO\MarginStatusData;

/**
 * Class Margin.
 *
 * @codeCoverageIgnore
 * @warning Margin api is not yet eligible to consume for now. Do not call any methods except getStatus() to check eligibility
 */
class Margin extends AbstractRequestManagerAware implements MarginInterface
{
    public function getMarginProfileInformationRaw(string $productId)
    {
        $query['product_id'] = $productId;

        return $this->getRequestManager()->createRequest('GET', '/margin/profile_information', $query)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getMarginProfileInformation(string $productId): MarginProfileDataInterface
    {
        // TODO: Implement getMarginProfileInformation() method.
    }

    public function getBuyingPowerRaw(string $productId)
    {
        $query['product_id'] = $productId;

        return $this->getRequestManager()->createRequest('GET', '/margin/buying_power', $query)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getBuyingPower(string $productId): BuyingPowerDataInterface
    {
        // TODO: Implement getBuyingPower() method.
    }

    public function getWithdrawalPowerRaw(string $currency)
    {
        $query['currency'] = $currency;

        return $this->getRequestManager()->createRequest('GET', '/margin/withdrawal_power', $query)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getWithdrawalPower(string $currency): WithdrawalPowerDataInterface
    {
        // TODO: Implement getWithdrawalPower() method.
    }

    public function getAllWithdrawalPowersRaw()
    {
        return $this->getRequestManager()->createRequest('GET', '/margin/withdrawal_power_all')->send();
    }

    /**
     * // todo need a real return typed value
     * {@inheritdoc}
     */
    public function getAllWithdrawalPowers()
    {
        // TODO: Implement getAllWithdrawalPowers() method.
    }

    public function getExitPlanRaw()
    {
        return $this->getRequestManager()->createRequest('GET', '/margin/exit_plan')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getExitPlan(): LiquidationStrategyDataInterface
    {
        // TODO: Implement getExitPlan() method.
    }

    public function listLiquidationHistoryRaw(?DateTimeInterface $after = null): array
    {
        $query = [];

        if ($after) {
            $query['after'] = $after->format(DateTime::ISO8601);
        }

        return $this->getRequestManager()->createRequest('GET', '/margin/liquidation_history', $query)->send();
    }

    /**
     * {@inheritdoc}
     */
    public function listLiquidationHistory(?DateTimeInterface $after = null): array
    {
        // TODO: Implement listLiquidationHistory() method.
    }

    public function getPositionsRefreshAmountRaw()
    {
        return $this->getRequestManager()->createRequest('GET', '/margin/position_refresh_amounts')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getPositionsRefreshAmount(): PositionRefreshAmountsData
    {
        // TODO: Implement getPositionsRefreshAmount() method.
    }

    public function getMarginStatusRaw()
    {
        return $this->getRequestManager()->createRequest('GET', '/margin/status')->send();
    }

    /**
     * {@inheritdoc}
     */
    public function getMarginStatus(): MarginStatusDataInterface
    {
        return MarginStatusData::createFromJson($this->getMarginStatusRaw());
    }
}
