# slack-slash-command-PHP

Want to run the Slack [Slash Commands](https://api.slack.com/slash-commands) in a no hassle PHP environment?

### Installing

Follow Slacks [instuctions](https://api.slack.com/slash-commands#setting_up_your_slash_command) as to get an App up and running who'll perform your slash commands.

Deploy the 'bot' to, well, any PHP enabled webhost, the version of PHP needed will depend on what functions you decide to use. Go for atleast 5.4+.

```
sudo apt-get install git wget -y
git clone https://github.com/ThatKalle/slack-slash-command-PHP.git
cp -r slack-slash-command-PHP/. /var/www/public_html
```

You'll also have to update the `$valid_tokens` array in [config.php](/config.php) with your own **Verification Token** provided by Slack when creating your App. [link](https://api.slack.com/apps).<br>
You can add multiple keys to authenticate the same bot to multiple Slacks _for example_.

Create a new Slash Command in Slack and point it to the .php file, for example https://FQDN/template to use [template.php](/template.php).

#### Examples

`/marvin lunch` will provide a list of local lunch restaurants, as well as a bonus on fridays! - [marvin.php](/example/marvin.php)

![marvin](/example/marvin-example.jpg)

`/at T12341212.1234` will provide handy links to open the corresponding Ticket or Task in Autotask PSA. - [at.php](/example/at.php)

![at](/example/at-example.jpg)


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* [imlinus](https://github.com/imlinus)
