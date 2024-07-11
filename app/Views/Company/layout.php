<!DOCTYPE html>
<html lang="en">
<head>
    <!-- css file here -->
    <?= $this->include('Company/Layout/Library') ?>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"><!--begin::App Wrapper-->
<div class="app-wrapper"> 
    <!-- header file here -->  
    <?= $this->include('Company/Layout/Header') ?>
    <!-- sidebar file here -->
    <?= $this->include('Company/Layout/Sidebar') ?>  
    <!-- dynmic main content -->
    <?= $this->renderSection('content') ?>   
    <!-- footer file here -->
    <?= $this->include('Company/Layout/Footer') ?>
</div> 
<!-- js file here --> 
<?= $this->include('Company/Layout/Js') ?>
<!-- dyanmic js appear here -->
<?= $this->renderSection('js') ?>
</body>
</html>

