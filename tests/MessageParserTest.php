<?php

namespace Docbot\Tests;

use Docbot\MessageParser;
use PHPUnit\Framework\TestCase;

class messageParserTest extends TestCase
{

    /**
     * @param $content
     * @param $expected
     * @return void
     * @dataProvider messageInputProvider
     */
    public function testMessageParserReturnsFalseOnBadInput($content, $expected)
    {
        $parser = new MessageParser();
        $message = new \stdClass();
        $message->content = $content;


        $this->assertEquals(
            $expected,
            $parser($message)
        );
    }

    public function messageInputProvider()
    {
        return [
            ["docsaurls", false],
            ["docs", false],
            ["a  a helpers", false],
            ["help helpers", false],
            ["bad input", false],
            ["homestead", false],
            ["docs pageDoesn'tExist", false],
            ["dOcS ArTiSan", "<https://laravel.com/docs/9.x/artisan>"],
            ["docs artisan", "<https://laravel.com/docs/9.x/artisan>"],
            ["docs authentication", "<https://laravel.com/docs/9.x/authentication>"],
            ["docs authorization", "<https://laravel.com/docs/9.x/authorization>"],
            ["docs billing", "<https://laravel.com/docs/9.x/billing>"],
            ["docs blade", "<https://laravel.com/docs/9.x/blade>"],
            ["docs broadcasting", "<https://laravel.com/docs/9.x/broadcasting>"],
            ["docs cache", "<https://laravel.com/docs/9.x/cache>"],
            ["docs cashier-paddle", "<https://laravel.com/docs/9.x/cashier-paddle>"],
            ["docs collections", "<https://laravel.com/docs/9.x/collections>"],
            ["docs configuration", "<https://laravel.com/docs/9.x/configuration>"],
            ["docs console-tests", "<https://laravel.com/docs/9.x/console-tests>"],
            ["docs container", "<https://laravel.com/docs/9.x/container>"],
            ["docs contracts", "<https://laravel.com/docs/9.x/contracts>"],
            ["docs contributions", "<https://laravel.com/docs/9.x/contributions>"],
            ["docs controllers", "<https://laravel.com/docs/9.x/controllers>"],
            ["docs csrf", "<https://laravel.com/docs/9.x/csrf>"],
            ["docs database-testing", "<https://laravel.com/docs/9.x/database-testing>"],
            ["docs database", "<https://laravel.com/docs/9.x/database>"],
            ["docs deployment", "<https://laravel.com/docs/9.x/deployment>"],
            ["docs documentation", "<https://laravel.com/docs/9.x/documentation>"],
            ["docs dusk", "<https://laravel.com/docs/9.x/dusk>"],
            ["docs eloquent-collections", "<https://laravel.com/docs/9.x/eloquent-collections>"],
            ["docs eloquent-mutators", "<https://laravel.com/docs/9.x/eloquent-mutators>"],
            ["docs eloquent-relationships", "<https://laravel.com/docs/9.x/eloquent-relationships>"],
            ["docs eloquent-resources", "<https://laravel.com/docs/9.x/eloquent-resources>"],
            ["docs eloquent-serialization", "<https://laravel.com/docs/9.x/eloquent-serialization>"],
            ["docs eloquent", "<https://laravel.com/docs/9.x/eloquent>"],
            ["docs encryption", "<https://laravel.com/docs/9.x/encryption>"],
            ["docs envoy", "<https://laravel.com/docs/9.x/envoy>"],
            ["docs errors", "<https://laravel.com/docs/9.x/errors>"],
            ["docs events", "<https://laravel.com/docs/9.x/events>"],
            ["docs facades", "<https://laravel.com/docs/9.x/facades>"],
            ["docs filesystem", "<https://laravel.com/docs/9.x/filesystem>"],
            ["docs fortify", "<https://laravel.com/docs/9.x/fortify>"],
            ["docs frontend", "<https://laravel.com/docs/9.x/frontend>"],
            ["docs hashing", "<https://laravel.com/docs/9.x/hashing>"],
            ["docs helpers", "<https://laravel.com/docs/9.x/helpers>"],
            ["docs homestead", "<https://laravel.com/docs/9.x/homestead>"],
            ["docs horizon", "<https://laravel.com/docs/9.x/horizon>"],
            ["docs http-client", "<https://laravel.com/docs/9.x/http-client>"],
            ["docs http-tests", "<https://laravel.com/docs/9.x/http-tests>"],
            ["docs installation", "<https://laravel.com/docs/9.x/installation>"],
            ["docs license", "<https://laravel.com/docs/9.x/license>"],
            ["docs lifecycle", "<https://laravel.com/docs/9.x/lifecycle>"],
            ["docs localization", "<https://laravel.com/docs/9.x/localization>"],
            ["docs logging", "<https://laravel.com/docs/9.x/logging>"],
            ["docs mail", "<https://laravel.com/docs/9.x/mail>"],
            ["docs middleware", "<https://laravel.com/docs/9.x/middleware>"],
            ["docs migrations", "<https://laravel.com/docs/9.x/migrations>"],
            ["docs mix", "<https://laravel.com/docs/9.x/mix>"],
            ["docs mocking", "<https://laravel.com/docs/9.x/mocking>"],
            ["docs notifications", "<https://laravel.com/docs/9.x/notifications>"],
            ["docs octane", "<https://laravel.com/docs/9.x/octane>"],
            ["docs packages", "<https://laravel.com/docs/9.x/packages>"],
            ["docs pagination", "<https://laravel.com/docs/9.x/pagination>"],
            ["docs passport", "<https://laravel.com/docs/9.x/passport>"],
            ["docs passwords", "<https://laravel.com/docs/9.x/passwords>"],
            ["docs pint", "<https://laravel.com/docs/9.x/pint>"],
            ["docs providers", "<https://laravel.com/docs/9.x/providers>"],
            ["docs queries", "<https://laravel.com/docs/9.x/queries>"],
            ["docs queues", "<https://laravel.com/docs/9.x/queues>"],
            ["docs rate-limiting", "<https://laravel.com/docs/9.x/rate-limiting>"],
            ["docs readme", "<https://laravel.com/docs/9.x/readme>"],
            ["docs redirects", "<https://laravel.com/docs/9.x/redirects>"],
            ["docs redis", "<https://laravel.com/docs/9.x/redis>"],
            ["docs releases", "<https://laravel.com/docs/9.x/releases>"],
            ["docs requests", "<https://laravel.com/docs/9.x/requests>"],
            ["docs responses", "<https://laravel.com/docs/9.x/responses>"],
            ["docs routing", "<https://laravel.com/docs/9.x/routing>"],
            ["docs sail", "<https://laravel.com/docs/9.x/sail>"],
            ["docs sanctum", "<https://laravel.com/docs/9.x/sanctum>"],
            ["docs scheduling", "<https://laravel.com/docs/9.x/scheduling>"],
            ["docs scout", "<https://laravel.com/docs/9.x/scout>"],
            ["docs seeding", "<https://laravel.com/docs/9.x/seeding>"],
            ["docs session", "<https://laravel.com/docs/9.x/session>"],
            ["docs socialite", "<https://laravel.com/docs/9.x/socialite>"],
            ["docs starter-kits", "<https://laravel.com/docs/9.x/starter-kits>"],
            ["docs structure", "<https://laravel.com/docs/9.x/structure>"],
            ["docs telescope", "<https://laravel.com/docs/9.x/telescope>"],
            ["docs testing", "<https://laravel.com/docs/9.x/testing>"],
            ["docs upgrade", "<https://laravel.com/docs/9.x/upgrade>"],
            ["docs urls", "<https://laravel.com/docs/9.x/urls>"],
            ["docs valet", "<https://laravel.com/docs/9.x/valet>"],
            ["docs validation", "<https://laravel.com/docs/9.x/validation>"],
            ["docs verification", "<https://laravel.com/docs/9.x/verification>"],
            ["docs views", "<https://laravel.com/docs/9.x/views>"],
            ["docs vite", "<https://laravel.com/docs/9.x/vite>"],
            ["docs 9.x csrf", "<https://laravel.com/docs/9.x/csrf>"],
            ["docs 8.x csrf", "<https://laravel.com/docs/8.x/csrf>"],
            ["docs 10.x csrf", false],
            ["docs csrf 9.x",  "<https://laravel.com/docs/9.x/csrf>"],
        ];
    }
}