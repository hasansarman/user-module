<?php

namespace Modules\User\Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SentinelGroupSeedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $groups = Sentinel::getRoleRepository();

        // Create an Admin group
        $groups->createModel()->firstOrCreate(
            [
                'name' => 'Admin',
                'slug' => 'admin',
            ]
        );

        // Create an Users group
        $groups->createModel()->firstOrCreate(
            [
                'name' => 'User',
                'slug' => 'user',
            ]
        );

        // Save the permissions
        $group = Sentinel::findRoleBySlug('admin');

        $group->addPermission('core.sidebar.group');
        /* Dashboard */
        $group->addPermission('dashboard.index');
        $group->addPermission('dashboard.update');
        $group->addPermission('dashboard.reset');
        /* Workbench */
        $group->addPermission('workshop.sidebar.group');
        $group->addPermission('workshop.modules.index');
        $group->addPermission('workshop.modules.show');
        $group->addPermission('workshop.modules.update');
        $group->addPermission('workshop.modules.disable');
        $group->addPermission('workshop.modules.enable');
        $group->addPermission('workshop.modules.publish');
        $group->addPermission('workshop.themes.index');
        $group->addPermission('workshop.themes.show');
        $group->addPermission('workshop.themes.publish');
        /* Roles */
        $group->addPermission('user.roles.index');
        $group->addPermission('user.roles.create');
        $group->addPermission('user.roles.edit');
        $group->addPermission('user.roles.destroy');
        /* Users */
        $group->addPermission('user.users.index');
        $group->addPermission('user.users.create');
        $group->addPermission('user.users.edit');
        $group->addPermission('user.users.destroy');
        /* API keys */
        $group->addPermission('account.api-keys.index');
        $group->addPermission('account.api-keys.create');
        $group->addPermission('account.api-keys.destroy');
        /* Menu */
        $group->addPermission('menu.menus.index');
        $group->addPermission('menu.menus.create');
        $group->addPermission('menu.menus.edit');
        $group->addPermission('menu.menus.destroy');
        $group->addPermission('menu.menuitems.index');
        $group->addPermission('menu.menuitems.create');
        $group->addPermission('menu.menuitems.edit');
        $group->addPermission('menu.menuitems.destroy');
        /* Media */
        $group->addPermission('media.medias.index');
        $group->addPermission('media.medias.create');
        $group->addPermission('media.medias.edit');
        $group->addPermission('media.medias.destroy');
        $group->addPermission('media.folders.index');
        $group->addPermission('media.folders.create');
        $group->addPermission('media.folders.edit');
        $group->addPermission('media.folders.destroy');
        /* Settings */
        $group->addPermission('setting.settings.index');
        $group->addPermission('setting.settings.edit');
        /* Page */
        $group->addPermission('page.pages.index');
        $group->addPermission('page.pages.create');
        $group->addPermission('page.pages.edit');
        $group->addPermission('page.pages.destroy');
        /* Translation */
        $group->addPermission('translation.translations.index');
        $group->addPermission('translation.translations.edit');
        $group->addPermission('translation.translations.export');
        $group->addPermission('translation.translations.import');
        /* Tags */
        $group->addPermission('tag.tags.index');
        $group->addPermission('tag.tags.create');
        $group->addPermission('tag.tags.edit');
        $group->addPermission('tag.tags.destroy');

        $group->save();
    }
}
