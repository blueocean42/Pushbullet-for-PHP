<?php

namespace Pushbullet;

class Chat
{
    use Pushable;

    public function __construct($properties, $apiKey)
    {
        foreach ($properties as $k => $v) {
            $this->$k = $v ?: null;
        }

        $this->apiKey = $apiKey;

        if (isset($this->with->email)) {
            $this->setPushableRecipient('email', $this->with->email);
            $this->pushable = true;
        } else {
            $this->pushable = false;
        }
    }

    /**
     * Delete the contact.
     *
     * @throws Exceptions\ConnectionException
     */
    public function delete()
    {
        Connection::sendCurlRequest(Connection::URL_CHATS . '/' . $this->iden, 'DELETE', null, false,
            $this->apiKey);
    }
}
