function cashierComponent() {
    return {
        // loading variables
        cashiers: [],
        loading: true,
        error: "",

        // addCashierForm variable
        form: { firstName: "", lastName: "", email: "",  password: "", confirmPassword: "", userRole: "admin", contactNumber: null},

        async loadCashiers() {
            this.loading = true;
            this.error = "";
            try {
                const data = await apiRequest(
                    "getCashiers",
                    { search: "" },
                    "cashierManager"
                );

                if (!Array.isArray(data)) {
                    this.cashiers = [];
                    this.error = "Invalid data format.";
                } else {
                    this.cashiers = data;
                }
            } catch (err) {
                console.error(err);
                this.error = "Failed to load cashiers.";
            } finally {
                this.loading = false;
            }
        },

        async addCashier() {
            const formData = this.form;

            try {
                await apiRequest("addCashier", formData, "cashierManager");

                toastSuccess("Successfully added cashier!");
                this.loadCashiers();
                this.resetForm();
                closeAddCashierModal();
            } catch (error) {
                toastFailed(error?.message || "Failed to add new cashier!");
            }
        },

        async changeUserStatus(cashier) {
            const formData = {
                cashier_id: cashier.cashier_id,
                new_cashier_status: cashier.user_status == "normal" ? "suspend" : "unsuspend" ,
            };

            try {
                if (parseInt(CURRENT_CASHIER_ID) === cashier.cashier_id) {
                    throw "You cannot change your own account status!";
                }

                const cashierData = await apiRequest(
                    "getCashierById",
                    formData,
                    "cashierManager"
                );
                const confirmed = await confirmAction(
                    `Are you sure you want to ${formData.new_cashier_status} ${cashierData.first_name} ${cashierData.last_name}?`
                );

                if (!confirmed) return;

                await apiRequest("changeCashierStatus", formData, "cashierManager");
                toastSuccess(
                    `${cashierData.first_name} ${cashierData.last_name} is now ${formData.new_cashier_status}ed!`
                );

                this.loadCashiers();
            } catch (error) {
                alertError(error);
            }
        },

        resetForm() {
            this.form = { firstName: "", lastName: "", email: "",  password: "", confirmPassword: "", userRole: "admin", contactNumber: null};
        }
    }
}