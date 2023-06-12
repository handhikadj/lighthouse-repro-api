<?php

namespace App\GraphQL\Subscriptions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Schema\Types\GraphQLSubscription;
use Nuwave\Lighthouse\Subscriptions\Subscriber;
use Illuminate\Support\Str;

final class AppEvent extends GraphQLSubscription
{
    public function decodeTopic($fieldName, $root): string
    {
        return strtoupper(
            Str::snake($fieldName)
        ) . '.' . $root['userId'];
    }

    public function encodeTopic(Subscriber $subscriber, string $fieldName): string
    {
        return strtoupper(
            Str::snake($fieldName)
        ) . '.' . $subscriber->args['userId'];
    }

    /**
     * Check if subscriber is allowed to listen to the subscription.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function authorize(Subscriber $subscriber, Request $request): bool
    {
        return $subscriber->context->user->id == $subscriber->args['userId'];
    }

    /**
     * Filter which subscribers should receive the subscription.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @param  mixed  $root
     * @return bool
     */
    public function filter(Subscriber $subscriber, $root): bool
    {
        return true;
    }
}
