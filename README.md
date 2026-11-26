# phpMyAdmin Button for Pelican Panel

A Pelican Panel plugin that adds a **phpMyAdmin** entry to the server sidebar, giving users a shortcut to your existing phpMyAdmin instance.

The plugin does not install phpMyAdmin or sign users in automatically. Access is still controlled by phpMyAdmin and your database permissions.

## Compatibility

- **Target panel version:** Pelican Panel `1.0.0-rc.4`.
- **Plugin API version:** `1`.
- Other panel versions are not verified. Check the release notes before installing.

## Installation

1. Download `phpmyadmin-button.zip` from this repository’s **Releases** page.
2. In Pelican Panel, go to **Administration → Plugins** and import the ZIP.
3. Install the plugin, then open a server and look for **phpMyAdmin** in the sidebar.

## Configuration

1. In Pelican, go to **Administration → Plugins** and enable **phpMyAdmin Button**.
2. Open the plugin's **Settings**, enter the full HTTPS URL of your phpMyAdmin installation, and save.
3. Open a server in Pelican, select **phpMyAdmin** from the sidebar, and click **Open phpMyAdmin**.

The URL applies to all servers on this panel. It is stored outside the plugin directory, so replacing the plugin files does not overwrite it. Do not include passwords, credentials, or login tokens in the URL. This plugin only opens a link: phpMyAdmin still handles its own authentication and access control.

### Planned: configure the URL from the admin panel

The goal is to let panel administrators set a single phpMyAdmin URL under **Administration → Plugins → phpMyAdmin Button → Settings**, without editing plugin files. The server sidebar shortcut will use the saved URL. **This setting is not implemented yet.**

## Updates

If your installed copy has an `update_url` in `plugin.json`, Pelican checks for compatible releases when you open **Administration → Plugins**. Select **Update** when it appears. If you're upgrading from a copy with no `update_url`, the first update must be installed manually.

### Publishing a release

1. Bump `version` in `plugin.json` and check `panel_version` against the version you tested.
2. Package the `phpmyadmin-button/` folder with `plugin.json`, `src/`, and `resources/` as `phpmyadmin-button.zip`.
3. Attach the ZIP to a GitHub release tagged `vX.Y.Z`.
4. Update `updates.json` with the new plugin version and the direct ZIP download URL under the matching Pelican Panel version. Make sure `update_url` in `plugin.json` points to the raw `updates.json` file.

## Author

Benjaliott