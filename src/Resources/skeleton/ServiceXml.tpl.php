<?php
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<container xmlns="http://symfony.com/schema/dic/services"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://symfony.com/schema/dic/services
        http://symfony.com/schema/dic/services/services-1.0.xsd">
    <services>
        <?php
        if ($hasServiceClass) {
            ?>
            <service id="<?php echo $serviceAlias; ?>" class="<?php echo $bundleNameSpace; ?>\<?php echo $serviceClassName; ?>"/>
            <service id="<?php echo $bundleNameSpace; ?>\<?php echo $serviceClassName; ?>" alias="<?php echo $serviceAlias; ?>" />
            <?php
        }
        ?>
    </services>
</container>