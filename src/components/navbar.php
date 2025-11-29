<?php
define("BASE_URL", "/orderManagementSystem/src/");

$filePath = $_SERVER['PHP_SELF'];
$parts = explode("/", trim($filePath, "/"));
?>

<div class="flex flex-row px-8 py-5 bg-amber-200 drop-shadow-xl justify-between">
	<div class="px-3">
		<h2 class="font-bold text-4xl hover:underline underline-offset-4">
            <a href="<?php echo BASE_URL; ?>">Pixelshop</a>
        </h2>
	</div>
	<div class="flex flex-row space-x-3">
		<?php if(strtolower($parts[2]) !== "admin") {?>
			<button
				class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-200 duration-150 cursor-pointer select-none"
				onclick="window.location.href='admin'">
				Cashier Dashboard</button>
			
		<?php } else { ?>
			<?php if(isset($_SESSION['cashier_id'])) {?>
				<button
					class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-200 duration-150 cursor-pointer select-none print:hidden"
					onclick="window.location.href='logout.php'">
					Logout</button>
			<?php } ?>
		<?php } ?>
		
	</div>
</div>
