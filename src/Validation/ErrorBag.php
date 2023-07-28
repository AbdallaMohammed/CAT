<?php

namespace CatPHP\Validation;

class ErrorBag
{
    /**
     * All of the registered messages.
     *
     * @var array
     */
    protected array $messages = [];

    /**
     * Create a new message bag instance.
     *
     * @param  array  $messages
     * @return void
     */
    public function __construct(array $messages = [])
    {
        foreach ($messages as $key => $value) {
            $this->messages[$key] = array_unique($value);
        }
    }

    /**
     * Get the keys present in the message bag.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->messages);
    }

    /**
     * Add a message to the message bag.
     *
     * @param  string  $key
     * @param  string  $message
     * @return $this
     */
    public function add($key, $message)
    {
        $this->messages[$key][] = $message;
    }

    /**
     * Determine if the message bag has any messages.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return ! $this->any();
    }

    /**
     * Determine if the message bag has any messages.
     *
     * @return bool
     */
    public function isNotEmpty()
    {
        return $this->any();
    }

    /**
     * Determine if the message bag has any messages.
     *
     * @return bool
     */
    public function any()
    {
        return $this->count() > 0;
    }

    /**
     * Get the number of messages in the message bag.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->keys());
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getMessages();
    }

    /**
     * Get the raw messages in the message bag.
     *
     * @return array
     */
    public function messages()
    {
        return $this->messages;
    }

    /**
     * Get the raw messages in the message bag.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages();
    }

    /**
     * Get the messages for the instance.
     *
     * @return self
     */
    public function getMessageBag()
    {
        return $this;
    }
}