<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Component\Grid\Definition;

class Filter
{
    private string $name;

    private string $type;

    /** @var string|bool|null */
    private $label;

    private bool $enabled = true;

    private ?string $template = null;

    private array $options = [];

    private array $formOptions = [];

    /** @var mixed */
    private $criteria;

    /**
     * Position equals to 100 to ensure that wile sorting filters by position ASC
     * the filters positioned by default will be last
     */
    private int $position = 100;

    private function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;

        $this->label = $name;
    }

    public static function fromNameAndType(string $name, string $type): self
    {
        return new self($name, $type);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|bool|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string|bool|null $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    public function getFormOptions(): array
    {
        return $this->formOptions;
    }

    public function setFormOptions(array $formOptions): void
    {
        $this->formOptions = $formOptions;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param mixed $criteria
     *
     * @psalm-suppress MissingReturnType
     */
    public function setCriteria($criteria)
    {
        $this->criteria = $criteria;
    }
}
