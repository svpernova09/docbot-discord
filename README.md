# Docbot-Discord

A simple bot to return Laravel documentation URLs based on prompts such as `docs homestead` or `docs authorization`. The goal is simplicity without over-engineering. Create your [Discord Bot](https://discord.com/developers/applications/) before continuing.

## Running the bot

* Clone the repo
* Export your `DOCBOT_TOKEN`: `export DOCBOT_TOKEN="3.1415926535"`
* Run `make install`
* Run the bot: `php bin/docbot.php`


## Development

Run the test suite with `make test`, `make clean` will remove `vendor`.
