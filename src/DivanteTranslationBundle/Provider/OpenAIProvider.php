<?php

declare(strict_types=1);

namespace DivanteTranslationBundle\Provider;

use DivanteTranslationBundle\Exception\TranslationException;

class OpenAIProvider extends AbstractProvider implements FormalityProviderInterface
{
    protected string $url = 'https://api.openai.com/v1';
    private const MARKET_START = '__AI_TRANSLATE_START__';
    private const MARKET_STOP = '__AI_TRANSLATE_STOP__';
    private const MESSAGE = 'Translate all values in the given text between "' . self::MARKET_START . '" and "' . self::MARKET_STOP . ' " markers to "%s" locale. If HTML tags are present, do not translate any part of the HTML markup, such as tag names, attributes, or classes (translate only the text inside HTML tags). Translate only the values of the text data between markers. Do not include the markers "' . self::MARKET_START . '" and "' . self::MARKET_STOP . '" in the final output. The output have to be a valid text, do not add quotation marks at the end and beginning of the output. "' . self::MARKET_START . '"%s"' . self::MARKET_STOP . '"';

    protected string $formality = 'gpt-3.5-turbo';

    public function setFormality(?string $formality): self
    {
        $this->formality = $formality ?? $this->formality;

        return $this;
    }

    /**
     * @throws TranslationException
     */
    public function translate(string $data, string $targetLanguage): string
    {
        $prompt = sprintf(self::MESSAGE, $targetLanguage, $data);
        try {
            $response = $this->client->request(
                'POST',
                'chat/completions',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'model' => $this->formality,
                        'messages' => [
                            [
                                'role' => 'user',
                                'content' => $prompt,
                            ]
                        ]
                    ]
                ]
            );

            if (array_key_exists('error', $response)) {
                throw new TranslationException(json_encode($response['error'], JSON_THROW_ON_ERROR));
            }
        } catch (\Throwable $exception) {
            throw new TranslationException($exception->getMessage());
        }
        $answer = $response['choices'][0]['message']['content'] ?? null;
        if ($answer === null) {
            throw new TranslationException($prompt);
        }

        $answer = preg_replace('/(\(Note.*)/', '', $answer);
        return str_replace([self::MARKET_START, self::MARKET_STOP], '', $answer);
    }

    public function getName(): string
    {
        return 'openai_translate';
    }
}
