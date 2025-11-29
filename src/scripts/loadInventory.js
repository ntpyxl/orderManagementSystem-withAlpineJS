function inventoryComponent() {
    return {
        search: "",
        layout: "customer",
        items: [],
        loading: true,
        error: "",

        async loadInventory() {
            this.loading = true;
            this.error = "";
            try {
                const data = await apiRequest(
                    "getInventoryItems",
                    { search: this.search },
                    "inventoryManager"
                );

                if (!Array.isArray(data)) {
                    this.items = [];
                    this.error = "Invalid data format.";
                } else {
                    this.items = data;
                }
            } catch (err) {
                console.error(err);
                this.error = "Failed to load inventory.";
            } finally {
                this.loading = false;
            }
        }
    };
}
