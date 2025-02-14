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

namespace spec\Sylius\Bundle\GridBundle\FieldTypes;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;
use Twig\Environment;

final class TwigFieldTypeSpec extends ObjectBehavior
{
    function let(DataExtractorInterface $dataExtractor, Environment $twig): void
    {
        $this->beConstructedWith($dataExtractor, $twig);
    }

    function it_is_a_grid_field_type(): void
    {
        $this->shouldImplement(FieldTypeInterface::class);
    }

    function it_uses_data_extractor_to_obtain_data_and_renders_it_via_twig(
        DataExtractorInterface $dataExtractor,
        Environment $twig,
        Field $field,
    ): void {
        $field->getPath()->willReturn('foo');

        $dataExtractor->get($field, ['foo' => 'bar'])->willReturn('Value');
        $twig->render('foo.html.twig', ['data' => 'Value', 'options' => ['template' => 'foo.html.twig']])->willReturn('<html>Value</html>');

        $this->render($field, ['foo' => 'bar'], [
            'template' => 'foo.html.twig',
        ])->shouldReturn('<html>Value</html>');
    }

    function it_uses_data_directly_if_dot_is_configured_as_path(
        Environment $twig,
        Field $field,
    ): void {
        $field->getPath()->willReturn('.');
        $twig->render('foo.html.twig', ['data' => 'bar', 'options' => ['template' => 'foo.html.twig']])->willReturn('<html>Bar</html>');

        $this->render($field, 'bar', ['template' => 'foo.html.twig'])->shouldReturn('<html>Bar</html>');
    }
}
