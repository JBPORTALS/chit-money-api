<?php

namespace Database\Seeders;

use App\Models\BankDetail;
use App\Models\Collector;
use App\Models\Contact;
use App\Models\Subscriber;
use Clerk\Backend\ClerkBackend;
use Clerk\Backend\Models\Operations\GetUserListRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        echo "🧹 Removing Clerk Users. \n";
        $this->deleteUsers();
        echo "🧹 Truncate All Data. \n";
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Disable FK checks

        DB::table('collectors')->truncate();
        DB::table('subscribers')->truncate();
        DB::table('contacts')->truncate();
        DB::table('organizations')->truncate();
        DB::table('batches')->truncate();
        DB::table('batch_subscriber')->truncate();
        DB::table('bank_details')->truncate();
        DB::table('payouts')->truncate();
        DB::table('payments')->truncate();
        DB::table('credit_scores')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  // Enable FK checks again

        $this->call(CollectorSeeder::class);
        $this->call(SubscriberSeeder::class);
        $this->call(BatchSubscriberSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(PayoutSeeder::class);
        $this->call(CreditScoreSeeder::class);
    }
}
