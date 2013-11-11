<?php
/**
 * @package      UserIdeas
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2013 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php if(!empty( $this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
    <div id="j-main-container" class="span10">
    <?php else : ?>
    <div id="j-main-container">
    <?php endif;?>
    <div class="span8">
        
	</div>
	
	<div class="span4">
        <a href="http://itprism.com/free-joomla-extensions/ecommerce-gamification/feedbacks-ideas-suggestions" target="_blank"><img src="../media/com_userideas/images/logo.png" alt="<?php echo JText::_("COM_USERIDEAS");?>" /></a>
        <a href="http://itprism.com" target="_blank" title="<?php echo JText::_("COM_USERIDEAS_ITPRISM_PRODUCT");?>"><img src="../media/com_userideas/images/product_of_itprism.png" alt="<?php echo JText::_("COM_USERIDEAS_PRODUCT");?>" /></a>
        <p><?php echo JText::_("COM_USERIDEAS_YOUR_VOTE"); ?></p>
        <p><?php echo JText::_("COM_USERIDEAS_SPONSORSHIP"); ?></p>
        <p><?php echo JText::_("COM_USERIDEAS_SUBSCRIPTION"); ?></p>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><?php echo JText::_("COM_USERIDEAS_INSTALLED_VERSION");?></td>
                    <td><?php echo $this->version->getMediumVersion();?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_USERIDEAS_RELEASE_DATE");?></td>
                    <td><?php echo $this->version->releaseDate?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_USERIDEAS_ITPRISM_LIBRARY_VERSION");?></td>
                    <td><?php echo $this->itprismVersion;?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_USERIDEAS_COPYRIGHT");?></td>
                    <td><?php echo $this->version->copyright;?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_USERIDEAS_LICENSE");?></td>
                    <td><?php echo $this->version->license;?></td>
                </tr>
            </tbody>
        </table>
	</div>
</div>