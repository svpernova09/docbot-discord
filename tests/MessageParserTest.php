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

    public function testMessageParserDoesNotFailIfGuildIdIsNotSet()
    {
        $parser = new MessageParser();
        $message = new \stdClass();
        $message->content = 'docs foo_bar'; // must be missing

        $this->assertFalse($parser($message));
    }

    public function testMessageParserDoesNotFailIfGuildIdIsNull()
    {
        $parser = new MessageParser();
        $message = new \stdClass();
        $message->content = 'docs foo_bar'; // must be missing
        $message->guild_id = null;

        $this->assertFalse($parser($message));
    }

    public function testMessageParserDoesNotFailIfGuildIdIsUnknown()
    {
        $parser = new MessageParser();
        $message = new \stdClass();
        $message->content = 'docs foo_bar'; // must be missing
        $message->guild_id = '123';

        $this->assertFalse($parser($message));
    }

    /**
     * @dataProvider guildSpecificMessage
     */
    public function testMessageParserReturnsResponseWhenGuildIdAndQueryMatch(
        string $guidId, string $content, string $expected
    ) {
        $parser = new MessageParser();
        $message = new \stdClass();
        $message->content = $content;
        $message->guild_id = $guidId;

        $this->assertEquals(
            $expected,
            $parser($message)
        );
    }

    /**
     * @dataProvider guildSpecificMessage
     */
    public function testMessageParserReturnsNullIfContentDoesNotMatch(
        string $guidId, string $content, string $expected
    ) {
        $parser = new MessageParser();
        $message = new \stdClass();
        $message->content = 'docs foo_bar';
        $message->guild_id = $guidId;

        $this->assertFalse(
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
            ["dOcS ArTiSan", "<https://laravel.com/docs/artisan>"],
            ["docs artisan", "<https://laravel.com/docs/artisan>"],
            ["docs authentication", "<https://laravel.com/docs/authentication>"],
            ["docs authorization", "<https://laravel.com/docs/authorization>"],
            ["docs billing", "<https://laravel.com/docs/billing>"],
            ["docs blade", "<https://laravel.com/docs/blade>"],
            ["docs broadcasting", "<https://laravel.com/docs/broadcasting>"],
            ["docs cache", "<https://laravel.com/docs/cache>"],
            ["docs cashier-paddle", "<https://laravel.com/docs/cashier-paddle>"],
            ["docs collections", "<https://laravel.com/docs/collections>"],
            ["docs configuration", "<https://laravel.com/docs/configuration>"],
            ["docs console-tests", "<https://laravel.com/docs/console-tests>"],
            ["docs container", "<https://laravel.com/docs/container>"],
            ["docs contracts", "<https://laravel.com/docs/contracts>"],
            ["docs contributions", "<https://laravel.com/docs/contributions>"],
            ["docs controllers", "<https://laravel.com/docs/controllers>"],
            ["docs csrf", "<https://laravel.com/docs/csrf>"],
            ["docs database-testing", "<https://laravel.com/docs/database-testing>"],
            ["docs database", "<https://laravel.com/docs/database>"],
            ["docs deployment", "<https://laravel.com/docs/deployment>"],
            ["docs documentation", "<https://laravel.com/docs/documentation>"],
            ["docs dusk", "<https://laravel.com/docs/dusk>"],
            ["docs eloquent-collections", "<https://laravel.com/docs/eloquent-collections>"],
            ["docs eloquent-mutators", "<https://laravel.com/docs/eloquent-mutators>"],
            ["docs eloquent-relationships", "<https://laravel.com/docs/eloquent-relationships>"],
            ["docs eloquent-resources", "<https://laravel.com/docs/eloquent-resources>"],
            ["docs eloquent-serialization", "<https://laravel.com/docs/eloquent-serialization>"],
            ["docs eloquent", "<https://laravel.com/docs/eloquent>"],
            ["docs encryption", "<https://laravel.com/docs/encryption>"],
            ["docs envoy", "<https://laravel.com/docs/envoy>"],
            ["docs errors", "<https://laravel.com/docs/errors>"],
            ["docs events", "<https://laravel.com/docs/events>"],
            ["docs facades", "<https://laravel.com/docs/facades>"],
            ["docs filesystem", "<https://laravel.com/docs/filesystem>"],
            ["docs fortify", "<https://laravel.com/docs/fortify>"],
            ["docs frontend", "<https://laravel.com/docs/frontend>"],
            ["docs hashing", "<https://laravel.com/docs/hashing>"],
            ["docs helpers", "<https://laravel.com/docs/helpers>"],
            ["docs homestead", "<https://laravel.com/docs/homestead>"],
            ["docs horizon", "<https://laravel.com/docs/horizon>"],
            ["docs http-client", "<https://laravel.com/docs/http-client>"],
            ["docs http-tests", "<https://laravel.com/docs/http-tests>"],
            ["docs installation", "<https://laravel.com/docs/installation>"],
            ["docs license", "<https://laravel.com/docs/license>"],
            ["docs lifecycle", "<https://laravel.com/docs/lifecycle>"],
            ["docs localization", "<https://laravel.com/docs/localization>"],
            ["docs logging", "<https://laravel.com/docs/logging>"],
            ["docs mail", "<https://laravel.com/docs/mail>"],
            ["docs middleware", "<https://laravel.com/docs/middleware>"],
            ["docs migrations", "<https://laravel.com/docs/migrations>"],
            ["docs mix", "<https://laravel.com/docs/mix>"],
            ["docs mocking", "<https://laravel.com/docs/mocking>"],
            ["docs notifications", "<https://laravel.com/docs/notifications>"],
            ["docs octane", "<https://laravel.com/docs/octane>"],
            ["docs packages", "<https://laravel.com/docs/packages>"],
            ["docs pagination", "<https://laravel.com/docs/pagination>"],
            ["docs passport", "<https://laravel.com/docs/passport>"],
            ["docs passwords", "<https://laravel.com/docs/passwords>"],
            ["docs pint", "<https://laravel.com/docs/pint>"],
            ["docs providers", "<https://laravel.com/docs/providers>"],
            ["docs queries", "<https://laravel.com/docs/queries>"],
            ["docs queues", "<https://laravel.com/docs/queues>"],
            ["docs rate-limiting", "<https://laravel.com/docs/rate-limiting>"],
            ["docs readme", "<https://laravel.com/docs/readme>"],
            ["docs redirects", "<https://laravel.com/docs/redirects>"],
            ["docs redis", "<https://laravel.com/docs/redis>"],
            ["docs releases", "<https://laravel.com/docs/releases>"],
            ["docs requests", "<https://laravel.com/docs/requests>"],
            ["docs responses", "<https://laravel.com/docs/responses>"],
            ["docs routing", "<https://laravel.com/docs/routing>"],
            ["docs sail", "<https://laravel.com/docs/sail>"],
            ["docs sanctum", "<https://laravel.com/docs/sanctum>"],
            ["docs scheduling", "<https://laravel.com/docs/scheduling>"],
            ["docs scout", "<https://laravel.com/docs/scout>"],
            ["docs seeding", "<https://laravel.com/docs/seeding>"],
            ["docs session", "<https://laravel.com/docs/session>"],
            ["docs socialite", "<https://laravel.com/docs/socialite>"],
            ["docs starter-kits", "<https://laravel.com/docs/starter-kits>"],
            ["docs structure", "<https://laravel.com/docs/structure>"],
            ["docs telescope", "<https://laravel.com/docs/telescope>"],
            ["docs testing", "<https://laravel.com/docs/testing>"],
            ["docs upgrade", "<https://laravel.com/docs/upgrade>"],
            ["docs urls", "<https://laravel.com/docs/urls>"],
            ["docs valet", "<https://laravel.com/docs/valet>"],
            ["docs validation", "<https://laravel.com/docs/validation>"],
            ["docs verification", "<https://laravel.com/docs/verification>"],
            ["docs views", "<https://laravel.com/docs/views>"],
            ["docs vite", "<https://laravel.com/docs/vite>"],
        ];
    }

    public function guildSpecificMessage(): array
    {
        return [
            ['235102104509743106', 'docs exit-vim', "`:q`"],
            ['235102104509743106', 'docs ben', "**BEST PHP RELEASE MANAGER EVER**"],
        ];
    }
}
