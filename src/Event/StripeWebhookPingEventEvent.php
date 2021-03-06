<?php

/*
 * This file is part of the SHQStripeBundle.
 *
 * Copyright Adamo Aerendir Crespi 2016-2017.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    Adamo Aerendir Crespi <hello@aerendir.me>
 * @copyright Copyright (C) 2016 - 2017 Aerendir. All rights reserved.
 * @license   MIT License.
 */

namespace SerendipityHQ\Bundle\StripeBundle\Event;

/**
 * Dispatched when a ping.* event has been received by the webhook endpoint.
 *
 * @author Adamo Crespi <hello@aerendir.me>
 */
class StripeWebhookPingEventEvent extends AbstractStripeWebhookEventEvent
{
    /**
     * May be sent by Stripe at any time to see if a provided webhook URL is working.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-ping
     */
    const PING = 'stripe.webhook.ping';
}
