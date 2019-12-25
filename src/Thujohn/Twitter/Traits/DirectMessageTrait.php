<?php

namespace Thujohn\Twitter\Traits;

use Illuminate\Support\Arr;
use BadMethodCallException;

trait DirectMessageTrait
{
    /**
     * Returns a single direct message event, specified by an id parameter.
     *
     * Parameters :
     * - id
     */
    public function getDm($parameters = [])
    {
        if (!array_key_exists('id', $parameters)) {
            throw new BadMethodCallException('Parameter required missing : id');
        }

        return $this->get('direct_messages/events/show', $parameters);
    }

    /**
     * Returns all Direct Message events (both sent and received) within the last 30 days. Sorted in reverse-chronological order.
     *
     * Parameters :
     * - count (1-50)
     * - cursor
     */
    public function getDms($parameters = [])
    {
        return $this->get('direct_messages/events/list', $parameters);
    }

    /**
     * Destroys the direct message specified in the required ID parameter. The authenticating user must be the recipient of the specified direct message.
     *
     * Parameters :
     * - id
     */
    public function destroyDm($parameters = [])
    {
        if (!array_key_exists('id', $parameters)) {
            throw new BadMethodCallException('Parameter required missing : id');
        }

        return $this->delete('direct_messages/events/destroy', $parameters);
    }

    /**
     * Publishes a new message_create event resulting in a Direct Message sent to a specified user from the authenticating user. Returns an event if successful. Supports publishing Direct Messages with optional Quick Reply and media attachment.
     *
     * Parameters :
     * - type
     * - message_create
     *
     * @see https://developer.twitter.com/en/docs/direct-messages/sending-and-receiving/api-reference/new-event
     */
    public function postDm($parameters = [])
    {
        if (!Arr::has($parameters, ['event.type', 'event.message_create.target.recipient_id', 'event.message_create.message_data.text'])) {
            throw new BadMethodCallException('Parameter required missing : event.type, event.message_create.target.recipient_id or event.message_create.message_data.text');
        }

        return $this->post('direct_messages/events/new', json_encode($parameters));
    }
}
