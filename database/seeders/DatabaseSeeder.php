<?php

namespace Database\Seeders;

use Clerk\Backend\ClerkBackend;
use Clerk\Backend\Models\Operations\GetUserListRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    protected ClerkBackend $clerk;

    public function __construct()
    {
        $this->clerk = ClerkBackend::builder()->setSecurity(getenv("CLERK_SECRET_KEY"))->build();
    }

    public function deleteUsers(): void
    {
        $response = $this->clerk->users->list(new GetUserListRequest(limit: 100));
        $users = $response->userList;
        foreach ($users as $user) {
            $this->clerk->users->delete($user->id);
        }

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Delete existing users first
        echo "🧹 Removing Clerk Users \n";
        $this->deleteUsers();

        $this->call(CollectorSeeder::class);
        $this->call(SubscriberSeeder::class);
        $this->call(BatchSubscriberSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(PayoutSeeder::class);
        $this->call(CreditScoreSeeder::class);
    }
}
