# "libxml" library extension, class used to parse XML configure files.

## Installation

Add to composer.json file

    ``` json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Deepelopment/XML"
        }
    ],
    "require": {
        "Deepelopment/XML": "dev-develop"
    },
    "scripts": {
        "post-install-cmd": "Deepelopment\\Composer_XML::postInstall",
        "post-update-cmd":  "Deepelopment\\Composer_XML::postUpdate"
    }
    ```

