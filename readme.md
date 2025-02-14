# Pimcore Translation Bundle
[![Tests Actions](https://github.com/DivanteLtd/pimcore-translation-bundle/workflows/Tests/badge.svg?branch=master)](https://github.com/DivanteLtd/pimcore-translation-bundle/actions)
[![Latest Stable Version](https://poser.pugx.org/divante-ltd/pimcore-translation-bundle/v/stable)](https://packagist.org/packages/divante-ltd/pimcore-translation-bundle)
[![Total Downloads](https://poser.pugx.org/divante-ltd/pimcore-translation-bundle/downloads)](https://packagist.org/packages/divante-ltd/pimcore-translation-bundle)
[![License](https://poser.pugx.org/divante-ltd/pimcore-translation-bundle/license)](https://github.com/DivanteLtd/divante-ltd/pimcore-translation-bundle/blob/master/LICENSE)

Copy data from the source language and translate it by using:
- Google Translate (https://cloud.google.com/translate)
- Deepl (https://www.deepl.com/en/docs-api/)
- Microsoft Translator (global region) (https://azure.microsoft.com/en-en/services/cognitive-services/translator/)

Supports input, textarea and wysiwyg fields.

**Table of Contents**
- [Pimcore Translation Bundle](#google-translate)
	- [Compatibility](#compatibility)
	- [Installing/Getting started](#installinggetting-started)
	- [Requirements](#requirements)
	- [Configuration](#configuration)
	- [How it works?](#how-it-works)
	- [Testing](#testing)
	- [Contributing](#contributing)
	- [Licence](#licence)
	- [Standards & Code Quality](#standards--code-quality)
	- [About Authors](#about-authors)

## Compatibility

This module is compatible with Pimcore 5.5.0 and higher. Including Pimcore 10.

## Installing/Getting started

```bash
composer require divante-ltd/pimcore-translation-bundle
```

## Configuration

Available providers:
- `google_translate`
- `deepl`
- `deepl_free` - free version of DeepL API
- `microsoft_translate`
- `openai_translate`

```
divante_translation:
    api_key: 
    source_lang:
    provider:  # default provider: google_translate
    formality: # working for providers deepl and deepl_free and openai_translate only.
```

#### DeepL Formality:
Sets whether the translated text should lean towards formal or informal language.\
This feature currently only works for target languages "DE" (German), "FR" (French), "IT" (Italian), "ES" (Spanish), "NL" (Dutch), "PL" (Polish), "PT-PT", "PT-BR" (Portuguese) and "RU" (Russian).

Possible options are:\
"default" (default)\
"more" - for a more formal language\
"less" - for a more informal language\

#### OpenAI Formality:
Sets which language model is used for processing requests. Each model varies in capabilities, performance, and cost.

Available Models:\
gpt-4-turbo – Optimized for performance and cost\
gpt-4, gpt-4-32k – Standard versions\
gpt-3.5-turbo, gpt-3.5 – Cheaper, faster alternatives\


### Enable the Bundle:
```bash
bin/console pimcore:bundle:enable DivanteTranslationBundle
```

## How to add new provider
Create Provider and implement interface 
```
DivanteTranslationBundle\Provider\ProviderInterface
```

If your provider has a option to set `formality` option implement interface:
```
DivanteTranslationBundle\Provider\FormalityProviderInterface
```

#### How it works?
![Screenshot](docs/translate.png)

## Testing
Unit Tests:
```bash
vendor/bin/phpunit
```

## Contributing
If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.

## Licence 
Pimcore Translation Bundle source code is completely free and released under the 
[MIT](https://github.com/DivanteLtd/pimcore-translation-bundle/blob/master/LICENSE).

## Standards & Code Quality
This module respects all Pimcore 5 code quality rules and our own PHPCS and PHPMD rulesets.

## About Authors
![Divante-logo](http://divante.co/logo-HG.png "Divante")

We are a Software House from Europe, existing from 2008 and employing about 150 people. Our core competencies are built 
around Magento, Pimcore and bespoke software projects (we love Symfony3, Node.js, Angular, React, Vue.js). 
We specialize in sophisticated integration projects trying to connect hardcore IT with good product design and UX.

We work for Clients like INTERSPORT, ING, Odlo, Onderdelenwinkel and CDP, the company that produced The Witcher game. 
We develop two projects: [Open Loyalty](http://www.openloyalty.io/ "Open Loyalty") - an open source loyalty program 
and [Vue.js Storefront](https://github.com/DivanteLtd/vue-storefront "Vue.js Storefront").

We are part of the OEX Group which is listed on the Warsaw Stock Exchange. Our annual revenue has been growing at a 
minimum of about 30% year on year.

Visit our website [Divante.co](https://divante.co/ "Divante.co") for more information.
