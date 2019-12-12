<?php

namespace Thujohn\Twitter\Traits;

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
        if ((!array_key_exists('type', $parameters) && !array_key_exists('message_create', $parameters))) {
            throw new BadMethodCallException('Parameter required missing : user_id, screen_name or text');
        }

        return $this->post('direct_messages/events/new', $parameters);
	}
	
	public function postDmWelcomeMessage($parameters = [])
	{
		if ((!array_key_exists('message_data', $parameters) && !array_key_exists('name', $parameters))) {
            throw new BadMethodCallException('Parameter required missing : message_data and name');
		}
		
		return $this->post('direct_messages/welcome_messages/new', $parameters);
	}

	public function getDmWelcomeMessage($parameters = [])
	{
		if (!array_key_exists('id', $parameters)) {
            throw new BadMethodCallException('Parameter required missing : id');
		}

		return $this->get('direct_messages/welcome_messages/show', $parameters);
	}

	public function updateDmWelcomeMessage($parameters = [])
	{
		if ((!array_key_exists('id', $parameters) && !array_key_exists('message_data', $parameters))) {
            throw new BadMethodCallException('Parameter required missing : id and message_data');
		}
		
		return $this->query('direct_messages/welcome_messages/update', 'PUT', $parameters = []);
	}

	public function destroyDmWelcomeMessage($parameters = [])
	{
		if (!array_key_exists('id', $parameters)) {
            throw new BadMethodCallException('Parameter required missing : id');
		}
		
		return $this->delete('direct_messages/welcome_messages/destroy', $parameters = []);
	}

	public function getDmWelcomeMessagesList($parameters = [])
	{
		return $this->get('direct_messages/welcome_messages/list', $parameters);
	}

	public function postDmWelcomeMessagesRule($parameters = [])
	{
		if (!array_key_exists('welcome_message_id', $parameters)) {
            throw new BadMethodCallException('Parameter required missing : welcome_message_id');
		}
		
		return $this->post('direct_messages/welcome_messages/rules/new', $parameters);
	}

	public function getDmWelcomeMessagesRule($parameters = [])
	{
		if (!array_key_exists('id', $parameters)) {
            throw new BadMethodCallException('Parameter required missing : id');
		}

		return $this->get('direct_messages/welcome_messages/rules/show', $parameters);
	}

	public function destroyDmWelcomeMessagesRule($parameters = [])
	{
		if (!array_key_exists('id', $parameters)) {
            throw new BadMethodCallException('Parameter required missing : id');
		}
		
		return $this->delete('direct_messages/welcome_messages/rules/destroy', $parameters = []);
	}

	public function getDmWelcomeMessagesListRules($parameters = [])
	{
		return $this->get('direct_messages/welcome_messages/rules/list', $parameters);
	}
}
