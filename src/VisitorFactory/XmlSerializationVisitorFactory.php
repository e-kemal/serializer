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

namespace JMS\Serializer\VisitorFactory;

use JMS\Serializer\Accessor\AccessorStrategyInterface;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializationVisitorInterface;
use JMS\Serializer\XmlSerializationVisitor;

/**
 *
 * @author Asmir Mustafic <goetas@gmail.com>
 */
class XmlSerializationVisitorFactory implements SerializationVisitorFactory
{
    private $defaultRootName = 'result';
    private $defaultVersion = '1.0';
    private $defaultEncoding = 'UTF-8';
    private $formatOutput = true;
    private $defaultRootNamespace;

    public function getVisitor(GraphNavigatorInterface $navigator, AccessorStrategyInterface $accessorStrategy, SerializationContext $context): SerializationVisitorInterface
    {
        return new XmlSerializationVisitor(
            $navigator,
            $accessorStrategy,
            $context,
            $this->formatOutput,
            $this->defaultEncoding,
            $this->defaultVersion,
            $this->defaultRootName,
            $this->defaultRootNamespace
        );
    }

    public function setDefaultRootName(string $name, ?string $namespace = null)
    {
        $this->defaultRootName = $name;
        $this->defaultRootNamespace = $namespace;
    }

    public function setDefaultVersion(string $version)
    {
        $this->defaultVersion = $version;
    }

    public function setDefaultEncoding(string $encoding)
    {
        $this->defaultEncoding = $encoding;
    }

    public function setFormatOutput(bool $formatOutput)
    {
        $this->formatOutput = (boolean)$formatOutput;
    }
}
