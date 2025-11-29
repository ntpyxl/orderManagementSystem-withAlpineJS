<div class="px-6 pt-5 pb-3 space-x-2">
    <?php if ($_SESSION['user_role'] === 'superadmin') { ?>
        <button id="cashiersAddCashierButton" class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">Add New Cashier</button>
    <?php } ?>
</div>

<div
    x-init="loadCashiers"
    class="flex flex-row flex-wrap px-10 py-5 justify-center">
    <template x-if="loading">
        <p class="text-gray-500 text-center">Loading cashiers...</p>
    </template>

    <!-- Error State -->
    <template x-if="error">
        <p class="text-red-500 text-center">Error</p>
    </template>

    <!-- No Results -->
    <template x-if="!loading && !error && cashiers.length === 0">
        <p class="text-gray-500 text-center">No cashiers found</p>
    </template>

    <!-- Cashier List -->
    <template x-for="cashier in cashiers" :key="cashier.cashier_id">
        <div class="flex flex-col m-3 w-92 h-full p-3 rounded-xl bg-amber-50 drop-shadow-lg">
            <div class="flex flex-row">
                <div class="px-2 rounded-xl w-fit">
                    <p><b>ID:</b> <span x-text="cashier.cashier_id"></span></p>
                    <img
                        :src="`${BASE_URL}/assets/defaultUserImage.jpg`"
                        :alt="`${cashier.first_name} ${cashier.last_name}`"
                        class="w-32 aspect-square border text-center object-contain wrap-anywhere select-none" />

                </div>

                <div class="flex flex-col w-full ml-3">
                    <h5 class="font-bold text-lg"><span x-text="cashier.first_name"></span> <span x-text="cashier.last_name"></span></h5>
                    <p class=""><span x-text="cashier.user_role"></span></p>

                    <div class="mt-2 wrap-anywhere">
                        <p class="text-right"><span x-text="cashier.user_email"></span></p>
                        <p class="text-right"><span x-text="cashier.contact_number"></span></p>
                        <p class="text-right"><span x-text="cashier.date_added"></span></p>
                    </div>
                </div>
            </div>

            <?php if ($_SESSION['user_role'] === 'superadmin') { ?>
                <template x-if="cashier.user_status === 'normal'">
                    <div class="flex w-full mt-3 space-x-0">
                        <button
                            class="flex-1 px-3 py-1 border-2 border-black bg-green-500 rounded-l-4xl cursor-pointer select-none">
                            Normal
                        </button>
                        <button
                            @click="changeUserStatus(cashier)"
                            class="flex-1 px-3 py-1 border-2 border-black rounded-r-4xl hover:bg-black hover:text-red-500 duration-150 cursor-pointer select-none">
                            Suspended
                        </button>
                    </div>
                </template>

                <template x-if="cashier.user_status === 'suspended'">
                    <div class="flex w-full mt-3 space-x-0">
                        <button
                            @click="changeUserStatus(cashier)"
                            class="flex-1 px-3 py-1 border-2 border-black rounded-l-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">
                            Normal
                        </button>
                        <button
                            class="flex-1 px-3 py-1 border-2 border-black bg-red-500 rounded-r-4xl cursor-pointer select-none">
                            Suspended
                        </button>
                    </div>
                </template>
            <?php } ?>
        </div>
    </template>
</div>



<div
    id="cashiersAddCashierModal"
    class="hidden fixed inset-0 z-20 bg-black/50 backdrop-blur-sm justify-center items-center">
    <div class="bg-white px-6 py-4 rounded-2xl shadow-xl relative">
        <h2 class="mb-2 text-center font-semibold text-xl">Cashiers - Add Cashier</h2>
        <div class="border rounded-2xl p-6">
            <form
                id="addCashierForm"
                @submit.prevent="submitForm"
                class="space-y-3">
                <div class="flex flex-row space-x-3">
                    <div class="flex flex-col">
                        <label for="firstNameField">First Name</label>
                        <input
                            type="text"
                            id="firstNameField"
                            x-model="form.firstName"
                            name="firstName"
                            class="px-2 py-1 border placeholder-gray-400 focus:placeholder-gray-500"
                            placeholder="John"
                            required>
                    </div>

                    <div class="flex flex-col">
                        <label for="lastNameField">Last Name</label>
                        <input
                            type="text"
                            id="lastNameField"
                            x-model="form.lastName"
                            name="lastName"
                            class="px-2 py-1 border placeholder-gray-400 focus:placeholder-gray-500"
                            placeholder="Doe"
                            required>
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="emailField">Email</label>
                    <input
                        type="email"
                        id="emailField"
                        x-model="form.email"
                        name="email"
                        class="px-2 py-1 border placeholder-gray-400 focus:placeholder-gray-500"
                        placeholder="jhondoe@email.com"
                        required>
                </div>

                <div class="flex flex-row space-x-3">
                    <div class="flex flex-col">
                        <label for="passwordField">Password</label>
                        <input
                            type="password"
                            id="passwordField"
                            x-model="form.password"
                            name="password"
                            class="px-2 py-1 border"
                            required>
                    </div>

                    <div class="flex flex-col">
                        <label for="confirmPasswordField">Confirm Password</label>
                        <input
                            type="password"
                            id="confirmPasswordField"
                            x-model="form.confirmPassword"
                            name="confirmPassword"
                            class="px-2 py-1 border"
                            required>
                    </div>
                </div>

                <div class="flex flex-row space-x-3">
                    <div class="flex flex-col grow">
                        <label for="userRoleField">User Role</label>
                        <select
                            id="userRoleField"
                            x-model="form.userRole"
                            name="userRole"
                            class="px-2 py-1 border cursor-pointer"
                            required>
                            <option value="admin" selected>Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="contactNumberField">Contact Number</label>
                        <input
                            type="tel"
                            id="contactNumberField"
                            x-model="form.contactNumber"
                            name="contactNumber"
                            class="px-2 py-1 border placeholder-gray-400 focus:placeholder-gray-500"
                            pattern="[0-9]{4} [0-9]{3} [0-9]{4}"
                            placeholder="0912 345 6789"
                            required>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex mt-3 justify-end gap-3">
            <button
                id="cashiersAddCashierSubmitButton"
                @click="addCashier()"
                class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none">
                Add Cashier
            </button>

            <button
                id="cashiersAddCashierCancelButton"
                class="px-3 py-1 border-2 border-black rounded-4xl hover:border-red-700 hover:bg-red-700 hover:text-amber-50 duration-150 cursor-pointer select-none">
                Cancel
            </button>
        </div>
    </div>
</div>