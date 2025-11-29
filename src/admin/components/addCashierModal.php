<div
  id="cashiersAddCashierModal"
  class="hidden fixed inset-0 z-20 bg-black/50 backdrop-blur-sm justify-center items-center"
>
    <div class="bg-white px-6 py-4 rounded-2xl shadow-xl relative">
        <h2 class="mb-2 text-center font-semibold text-xl">Cashiers - Add Cashier</h2>
        <div class="border rounded-2xl p-6">
            <form id="addCashierForm" onsubmit="cashiersAddCashier(event)" class="space-y-3">
                <div class="flex flex-row space-x-3">
                    <div class="flex flex-col">
                        <label for="firstNameField">First Name</label>
                        <input
                            type="text"
                            id="firstNameField"
                            name="firstName"
                            class="px-2 py-1 border placeholder-gray-400 focus:placeholder-gray-500"
                            placeholder="John"
                            required
                        >
                    </div>

                    <div class="flex flex-col">
                        <label for="lastNameField">Last Name</label>
                        <input
                            type="text"
                            id="lastNameField"
                            name="lastName"
                            class="px-2 py-1 border placeholder-gray-400 focus:placeholder-gray-500"
                            placeholder="Doe"
                            required
                        >
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="emailField">Email</label>
                    <input
                        type="email"
                        id="emailField"
                        name="email"
                        class="px-2 py-1 border placeholder-gray-400 focus:placeholder-gray-500"
                        placeholder="jhondoe@email.com"
                        required
                    >
                </div>

                <div class="flex flex-row space-x-3">
                    <div class="flex flex-col">
                        <label for="passwordField">Password</label>
                        <input
                            type="password"
                            id="passwordField"
                            name="password"
                            class="px-2 py-1 border"
                            required
                        >
                    </div>

                    <div class="flex flex-col">
                        <label for="confirmPasswordField">Confirm Password</label>
                        <input
                            type="password"
                            id="confirmPasswordField"
                            name="confirmPassword"
                            class="px-2 py-1 border"
                            required
                        >
                    </div>
                </div>

                <div class="flex flex-row space-x-3">
                    <div class="flex flex-col grow">
                        <label for="userRoleField">User Role</label>
                        <select
                            id="userRoleField"
                            name="userRole"
                            class="px-2 py-1 border cursor-pointer"
                            required
                        >
                            <option value="admin" selected>Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="contactNumberField">Contact Number</label>
                        <input
                            type="tel"
                            id="contactNumberField"
                            name="contactNumber"
                            class="px-2 py-1 border placeholder-gray-400 focus:placeholder-gray-500"
                            pattern="[0-9]{4} [0-9]{3} [0-9]{4}"
                            placeholder="0912 345 6789"
                            required
                        >
                    </div>
                </div>
            </form>
        </div>

        <div class="flex mt-3 justify-end gap-3">
            <button
                id="cashiersAddCashierSubmitButton"
                type="submit"
                form="addCashierForm"
                class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none"
            >
                Add Cashier
            </button>

            <button
                id="cashiersAddCashierCancelButton"
                class="px-3 py-1 border-2 border-black rounded-4xl hover:border-red-700 hover:bg-red-700 hover:text-amber-50 duration-150 cursor-pointer select-none"
            >
                Cancel
            </button>
        </div>
    </div>
</div>