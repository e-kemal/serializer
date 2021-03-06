<?php

declare(strict_types=1);

/*
 * Copyright 2016 Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace JMS\Serializer\Tests\Fixtures;

use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\DeserializationVisitorInterface;
use JMS\Serializer\Metadata\ClassMetadata;

/**
 * Object constructor that allows deserialization into already constructed
 * objects passed through the deserialization context
 */
class InitializedObjectConstructor implements ObjectConstructorInterface
{
    private $fallbackConstructor;

    /**
     * Constructor.
     *
     * @param ObjectConstructorInterface $fallbackConstructor Fallback object constructor
     */
    public function __construct(ObjectConstructorInterface $fallbackConstructor)
    {
        $this->fallbackConstructor = $fallbackConstructor;
    }

    /**
     * {@inheritdoc}
     */
    public function construct(DeserializationVisitorInterface $visitor, ClassMetadata $metadata, $data, array $type, DeserializationContext $context)
    {
        if ($context->hasAttribute('target') && $context->getDepth() === 1) {
            return $context->getAttribute('target');
        }

        return $this->fallbackConstructor->construct($visitor, $metadata, $data, $type, $context);
    }

}
