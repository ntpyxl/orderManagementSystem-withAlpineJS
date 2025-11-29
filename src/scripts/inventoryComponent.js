function inventoryComponent() {
    return {
        // loading variables
        items: [],
        loading: true,
        error: "",

        // addItemForm variables
        form: { itemName: "", itemPrice: 0, imageFile: null },
        previewImage: "",

        async loadInventory() {
            this.loading = true;
            this.error = "";
            try {
                const data = await apiRequest(
                    "getInventoryItems",
                    { search: "" },
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
        },

        handleImageFile(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.imageFile = file;
                this.previewImage = URL.createObjectURL(file);
            } else {
                this.form.imageFile = null;
                this.previewImage = '';
            }
        },

        async addItem() {
			const formData = {};
			formData.itemName = this.form.itemName;
			formData.itemPrice = this.form.itemPrice;

            if (!formData.itemName || !formData.itemPrice || !this.form.imageFile) return;

            try {
                const uploadResult = await this.uploadItemImage();
				if (!uploadResult.success) {
					throw new Error(uploadResult.message || "Image upload failed");
				}

				formData.itemImage = uploadResult.fileName;
                await apiRequest("addItem", formData, "inventoryManager");

                toastSuccess('Successfully added item!');
				this.resetForm();
                closeAddItemModal()
                await this.loadInventory();

            } catch (error) {
                toastFailed(error.message || 'Failed to add item!');
            }
        },

        async uploadItemImage() {
            if (!this.form.imageFile) {
                return { success: false, message: "No image selected" };
            }

            const formData = new FormData();
            formData.append("action", "uploadItemImage");
            formData.append("itemImage", this.form.imageFile);

            try {
                const response = await fetch(`${BASE_URL}/api/inventoryManager.php`, {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();

                if (!response.ok || !result.success) {
                    throw new Error(result.message || "Image upload failed");
                }

                return result;

            } catch (error) {
                console.error("Upload error:", error);
                return { success: false, message: error.message };
            }
        },

        resetForm() {
            this.form = { itemName: "", itemPrice: 0, imageFile: null };
            this.previewImage = "";
        }
    };
}