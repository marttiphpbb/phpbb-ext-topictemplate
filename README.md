# PhpBB Extension - marttiphpbb Topic Template

[Topic on phpBB.com](https://www.phpbb.com/community/viewtopic.php?f=456&t=2468891)

## Requirements

phpBB 3.2+ PHP 7+

## Features

With this extension you can set a Topic Template (text) in the ACP for each forum in your board.
Whenever someone starts a topic. The editor gets prefilled with the text that you defined.

## Screenshots

**Add or Edit a forum in the ACP**

![ACP](/doc/acp.png)

**Posting a new topic in the forum**

![Posting](/doc/posting.png)

## Migrating from "Posting Template"

This is an upgrade and rewrite of my ["Posting Template" extension](https://www.phpbb.com/customise/db/extension/posting_template_4/).
It got renamed to "Topic Template" to reflect better what it does.

This extension checks in the install process if the "Posting Template" extension is enabled.
If this is the case, all template data is copied to this extension.

In order to migrate the templates from "Posting Template":

* keep "Posting Template" enabled.
* Install and enable this extension.
* Disable "Posting Template".

## Quick Install

You can install this on the latest release of phpBB 3.2 by following the steps below:

* Create `marttiphpbb/topictemplate` in the `ext` directory.
* Download and unpack the repository into `ext/marttiphpbb/topictemplate`
* Enable `Topic Template` in the ACP at `Customise -> Manage extensions`.
* You can start editing the Topic Template in the Forum ACP for each Forum.

## Uninstall

* Disable `Topic Template` in the ACP at `Customise -> Extension Management -> Extensions`.
* To permanently uninstall, click `Delete Data`. Optionally delete the `/ext/marttiphpbb/topictemplate` directory.

## Support

* Report bugs and other issues to the [Issue Tracker](https://github.com/marttiphpbb/phpbb-ext-topictemplate/issues).

### License

[GPL-2.0](license.txt)
