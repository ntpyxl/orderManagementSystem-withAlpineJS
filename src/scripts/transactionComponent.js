function transactionComponent() {
    return {
        startDate: "",
        endDate: "",
        transactions: [],
        loading: true,
        error: false,

        async loadTransactions() {
            this.loading = true;
            this.error = false;

            try {
                let formData = {};

                if (this.startDateSort) formData.start_date_sort = this.startDateSort;
                if (this.endDateSort) formData.end_date_sort = this.endDateSort;

                const data = await apiRequest(
                    "getTransactionHistory",
                    formData,
                    "transactionManager"
                );

                if (!Array.isArray(data)) {
                    this.transactions = [];
                    return;
                }

                this.transactions = data;
            } catch (err) {
                console.error(err);
                this.error = true;
            } finally {
                this.loading = false;
            }
        },

        get totalAmount() {
            return this.transactions.reduce((sum, item) => sum + item.price * item.item_quantity, 0);
        },

        updateStartDate() {
            this.startDateSort = this.startDate 
                ? `${this.startDate} 00:00:00`
                : "";
            this.loadTransactions();
        },

        updateEndDate() {
            this.endDateSort = this.endDate
                ? `${this.endDate} 23:59:59`
                : "";
            this.loadTransactions();
        }
    };
}
