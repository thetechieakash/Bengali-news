<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => 'Complete control of the site.',
        ],
        'admin' => [
            'title'       => 'Admin',
            'description' => 'Day to day administrators of the site.',
        ],
        'author' => [
            'title'       => 'Author',
            'description' => 'News publisher.',
        ],
        'user' => [
            'title'       => 'User',
            'description' => 'General users of the site. Often customers.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        // Dashboard
        'dashboard.view'   => 'View dashboard',

        // Categories
        'categories.view'   => 'View categories',
        'categories.create' => 'Create categories',
        'categories.update' => 'Update categories',
        'categories.delete' => 'Delete categories',
        'categories.status' => 'Update category status',

        // Sub categories
        'sub_categories.view'   => 'View sub categories',
        'sub_categories.create' => 'Create sub categories',
        'sub_categories.update' => 'Update sub categories',
        'sub_categories.delete' => 'Delete sub categories',

        // Child categories
        'child_categories.view'   => 'View child categories',
        'child_categories.create' => 'Create child categories',
        'child_categories.update' => 'Update child categories',
        'child_categories.delete' => 'Delete child categories',

        // Comments
        'comments.view'   => 'View comments',
        'comments.approve' => 'Approve comments',
        'comments.unpublish' => 'Unpublish comments',
        'comments.reply'  => 'Reply comments',
        'comments.delete' => 'Delete comments',

        // Tags
        'tags.view'   => 'View tags',
        'tags.create' => 'Create tags',
        'tags.update' => 'Update tags',
        'tags.delete' => 'Delete tags',

        // Media
        'media.view'   => 'View media',
        'media.create' => 'Create media',
        'media.delete' => 'Delete media',

        // Documents
        'documents.view'   => 'View documents',
        'documents.create' => 'Create documents',
        'documents.delete' => 'Delete documents',

        // Ads
        'ads.view'   => 'View ads',
        'ads.create' => 'Create ads',
        'ads.update' => 'Update ads',
        'ads.delete' => 'Delete ads',
        'ads.status' => 'Toggle ad status',

        // News
        'news.view'   => 'View news',
        'news.create' => 'Create news',
        'news.update' => 'Update news',
        'news.delete' => 'Delete news',
        'news.status' => 'Change news status',

        // News
        'author.view'   => 'View author',
        'author.create' => 'Create author',
        'author.update' => 'Update author',
        'author.delete' => 'Delete author',

        // Message
        'messages.view' => 'View messages',
        'messages.delete' => 'Delete messages'
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => ['*'],
        'admin' => [],
        'author' => [],
        'user' => [],
    ];
}
