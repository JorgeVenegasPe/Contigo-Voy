<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Numbers\V2\RegulatoryCompliance;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string $sid
 * @property string $accountSid
 * @property string $friendlyName
 * @property string $mimeType
 * @property string $status
 * @property string $failureReason
 * @property string $type
 * @property array $attributes
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $url
 */
class SupportingDocumentInstance extends InstanceResource {
    /**
     * Initialize the SupportingDocumentInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, array $payload, string $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'mimeType' => Values::array_get($payload, 'mime_type'),
            'status' => Values::array_get($payload, 'status'),
            'failureReason' => Values::array_get($payload, 'failure_reason'),
            'type' => Values::array_get($payload, 'type'),
            'attributes' => Values::array_get($payload, 'attributes'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return SupportingDocumentContext Context for this SupportingDocumentInstance
     */
    protected function proxy(): SupportingDocumentContext {
        if (!$this->context) {
            $this->context = new SupportingDocumentContext($this->version, $this->solution['sid']);
        }

        return $this->context;
    }

    /**
     * Fetch the SupportingDocumentInstance
     *
     * @return SupportingDocumentInstance Fetched SupportingDocumentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): SupportingDocumentInstance {
        return $this->proxy()->fetch();
    }

    /**
     * Update the SupportingDocumentInstance
     *
     * @param array|Options $options Optional Arguments
     * @return SupportingDocumentInstance Updated SupportingDocumentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): SupportingDocumentInstance {
        return $this->proxy()->update($options);
    }

    /**
     * Delete the SupportingDocumentInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool {
        return $this->proxy()->delete();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name) {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Numbers.V2.SupportingDocumentInstance ' . \implode(' ', $context) . ']';
    }
}