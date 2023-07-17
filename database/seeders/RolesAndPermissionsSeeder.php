<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_array = [
            'view-logo','create-logo','delete-logo',
            'view-about','create-about','update-about','delete-about',
            'view-banner','create-banner','update-banner','delete-banner',
            'view-category','create-category','update-category','delete-category',
            'view-city','create-city','update-city','delete-city',
            'view-contact','create-contact','update-contact','delete-contact',
            'view-country','create-country','update-country','delete-country',
            'view-coupon','create-coupon','update-coupon','delete-coupon',
            'view-discount','create-discount','update-discount','delete-discount',
            'view-faq','create-faq','update-faq','delete-faq',
            'view-feature','create-feature','update-feature','delete-feature',
            'view-product','create-product','update-product','delete-product',
            'create-product-discount','delete-product-discount',
            'view-size','create-size','update-size','delete-size',
            'view-permission','create-permission','update-permission','delete-permission',
            'view-role','create-role','update-role','delete-role',
            'view-user','create-user','update-user','delete-user',
            'view-order','update-order','delete-order',
            'view-subscriber','delete-subscriber',
            'view-newsletter','create-newsletter','delete-newsletter',
            'view-message','reply-message','delete-message',
            'view-mail-settings','update-mail-settings',
        ];

        $permissions = collect($permissions_array)->map(function($permission){
            return ['name' => $permission, 'created_at'=>now(),];
        })->toArray();

        Permission::insert($permissions);

        $permissionsByRole = [
            'super-admin' => Permission::all(),
            'admin' => [
                'view-logo','create-logo','delete-logo',
                'view-about','create-about','update-about','delete-about',
                'view-banner','create-banner','update-banner','delete-banner',
                'view-category','create-category','update-category','delete-category',
                'view-city','create-city','update-city','delete-city',
                'view-contact','create-contact','update-contact','delete-contact',
                'view-country','create-country','update-country','delete-country',
                'view-coupon','create-coupon','update-coupon','delete-coupon',
                'view-discount','create-discount','update-discount','delete-discount',
                'view-faq','create-faq','update-faq','delete-faq',
                'view-feature','create-feature','update-feature','delete-feature',
                'view-product','create-product','update-product','delete-product',
                'create-product-discount','delete-product-discount',
                'view-size','create-size','update-size','delete-size',
                'view-user','create-user',
                'view-order','update-order','delete-order',
                'view-subscriber','delete-subscriber',
                'view-newsletter','create-newsletter','delete-newsletter',
                'view-message','reply-message','delete-message',
                'view-mail-settings','update-mail-settings',
            ],
            'manager' => [
                'view-logo','create-logo',
                'view-about','create-about','update-about',
                'view-banner','create-banner','update-banner',
                'view-category','create-category','update-category',
                'view-city','create-city','update-city',
                'view-contact','create-contact','update-contact',
                'view-country','create-country','update-country',
                'view-coupon','create-coupon','update-coupon',
                'view-discount','create-discount','update-discount',
                'view-faq','create-faq','update-faq',
                'view-feature','create-feature','update-feature',
                'view-product','create-product','update-product',
                'create-product-discount',
                'view-size','create-size','update-size',
                'view-user','view-order','update-order',
                'view-subscriber','view-newsletter','create-newsletter',
                'view-message','reply-message',
            ],
        ];


        foreach($permissionsByRole as $role => $permissionNames) {

            $role = Role::create(['name' => $role, 'created_at'=>now(),]);

            $role->givePermissionTo($permissionNames);

        }

    }
}
