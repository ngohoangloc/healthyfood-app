<?php
namespace App\Repositories;

use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class AccountRepository
{
    public function getByUsername(string $username)
    {
        return Account::where('username', $username)->first();
    }

    public function getAccountById(int $id)
    {
        return Account::where('id', $id)->first();
    }

    public function create($request)
    {
        $newAccount = Account::create([
            'username' => $request['username'],
            'password' => Hash::make($request['password_again']),
            'active' => $request['active'],
        ]);

        $userRepository = new UserRepository();

        $userRepository->create([
            'account_id' => $newAccount->id,
            'fullName' => $request['fullName'],
            'phone'=> $request['phone'],
            'address' => $request['address'],
            'role_id'=> $request['role_id'],
        ]);

        return $newAccount;
    }

    public function update($id, $request)
    {
        $updateAccount = $this->getAccountById($id);

        $updateAccount->update([
            'username'=> $request['username'],
            'active' => $request['active'],
        ]);

        $userRepository = new UserRepository();
        $userRepository->update($updateAccount->user->id, [
            'fullName' => $request['fullName'],
            'phone'=> $request['phone'],
            'address' => $request['address'],
            'role_id'=> $request['role_id'],
        ]);

    }

    public function delete($id)
    {
        $userRepository = new UserRepository();
        $deleteAccount = $this->getAccountById($id);

        $userRepository->delete($deleteAccount->user->id);
        $deleteAccount->delete();
    }
}
