<?php
namespace Docbot;

class MessageParser {
    protected $docs = [
                "artisan",
                "authentication",
                "authorization",
                "billing",
                "blade",
                "broadcasting",
                "cache",
                "cashier-paddle",
                "collections",
                "configuration",
                "console-tests",
                "container",
                "contracts",
                "contributions",
                "controllers",
                "csrf",
                "database-testing",
                "database",
                "deployment",
                "documentation",
                "dusk",
                "eloquent-collections",
                "eloquent-mutators",
                "eloquent-relationships",
                "eloquent-resources",
                "eloquent-serialization",
                "eloquent",
                "encryption",
                "envoy",
                "errors",
                "events",
                "facades",
                "filesystem",
                "fortify",
                "frontend",
                "hashing",
                "helpers",
                "homestead",
                "horizon",
                "http-client",
                "http-tests",
                "installation",
                "license",
                "lifecycle",
                "localization",
                "logging",
                "mail",
                "middleware",
                "migrations",
                "mix",
                "mocking",
                "notifications",
                "octane",
                "packages",
                "pagination",
                "passport",
                "passwords",
                "pint",
                "providers",
                "queries",
                "queues",
                "rate-limiting",
                "readme",
                "redirects",
                "redis",
                "releases",
                "requests",
                "responses",
                "routing",
                "sail",
                "sanctum",
                "scheduling",
                "scout",
                "seeding",
                "session",
                "socialite",
                "starter-kits",
                "structure",
                "telescope",
                "testing",
                "upgrade",
                "urls",
                "valet",
                "validation",
                "verification",
                "views",
                "vite",
            ];
    
        protected $notDocs = [
            // phpugly
            "235102104509743106" => [
                "exit-vim" => "`:q`",
                "ben" => "**BEST PHP RELEASE MANAGER EVER**",
            ],
        ];

    protected $versions = [
                "9.x",
                "8.x",
                "7.x",
                "6.x",
    ];

    public function __invoke($message)
    {
        $content = strtolower($message->content);

        // Grab the first 4 chars for our trigger
        $trigger = substr($content, 0, 5);

        // Grab everything after the first 5 chars
        $query = substr($content, 5);

        // Check if version is available in command
        $pattern = '/\b([0-9]+\.([0-9]|[x])+)\b/';
        preg_match($pattern, $query, $matches);

        if ($matches) {
            $query = preg_replace($pattern, '', $query);
            $version = in_array($matches[0], $this->versions) ? $matches[0] : null;
        }

        $query = trim($query);

        if($trigger === "docs ")
        {
            if(in_array($query, $this->docs)){
                if (isset($version))
                    return "<https://laravel.com/docs/$version/$query>";

                return "<https://laravel.com/docs/$query>";
            }
            
            try {
                if(null !== $message->guild_id ) {
                    $guildId = (string) $message->guild_id;
                    if(isset($this->notDocs[$guildId])
                        && isset($this->notDocs[$guildId][$query]))
                    {
                        return $this->notDocs[$guildId][$query];
                    }
                }
            } catch (\Throwable $t) {}
        }

        return false;
    }
}
