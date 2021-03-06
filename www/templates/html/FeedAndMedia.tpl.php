<?php
$controller->setReplacementData('head', '<link rel="alternate" type="application/rss+xml" title="'.htmlentities($context->feed->title, ENT_QUOTES).'" href="?format=xml" />');
$controller->setReplacementData('title', 'UNL | MediaHub | '.htmlspecialchars($context->feed->title));
$controller->setReplacementData('breadcrumbs', '<ul> <li><a href="http://www.unl.edu/">UNL</a></li> <li><a href="'.UNL_MediaHub_Controller::getURL().'">MediaHub</a></li><li><a href="'.UNL_MediaHub_Controller::getURL().'channels/">All Channels</a></li><li>'.htmlspecialchars($context->feed->title).'</li></ul>');
$feed_url = htmlentities(UNL_MediaHub_Controller::getURL($context->feed), ENT_QUOTES);
$baseUrl = UNL_MediaHub_Controller::getURL();
$user = UNL_MediaHub_AuthService::getInstance()->getUser();
?>
<div class="wdn-band wdn-light-neutral-band mh-feed-info">
    <div class="wdn-inner-wrapper">
        <h1 class="wdn-brand wdn-pull-left"><?php echo htmlentities($context->feed->title) ?></h1>
        <?php if ($user && $context->feed->userCanEdit($user)): ?>
            <a href="<?php echo UNL_MediaHub_Manager::getURL()?>?view=feedmetadata&amp;id=<?php echo $context->feed->id ?>" class="wdn-button wdn-button-brand wdn-pull-left mh-channel-edit-button">Edit</a>
        <?php endif ?>
        <div class="wdn-pull-right mh-rss"><a href="?format=xml" title="RSS feed for this channel"><span class="wdn-icon-rss-squared" aria-hidden="true"></span></a></div>
        <div class="wdn-grid-set">
            <div class="bp2-wdn-col-one-fourth wdn-pull-right">
                <div class="mh-channel-thumb wdn-center">
                <?php $url = htmlentities(UNL_MediaHub_Controller::getURL($context->feed), ENT_QUOTES) ?>
                <?php if($context->feed->hasImage()): ?>
                    <img
                    src="<?php echo $url; ?>/image"
                    alt="<?php echo htmlentities($context->feed->title, ENT_QUOTES); ?> Image">
                <?php else: ?>
                    <div>
                        <object type="image/svg+xml" data="<?php echo $baseUrl; ?>/templates/html/css/images/channel-icon.svg">
                            <img src="<?php echo $baseUrl; ?>/templates/html/css/images/channel-icon-white.png" alt="<?php echo htmlentities($context->feed->title, ENT_QUOTES); ?> Image">
                        </object>
                    </div>
                <?php endif; ?>
                </div>
            </div>
            <div class="bp2-wdn-col-three-fourths">
                <p><?php echo htmlentities($context->feed->description) ?></p>
            </div>
            <div class="bp2-wdn-col-one-fourth wdn-pull-right mh-feed-stats">
                <?php echo $savvy->render($context->feed, 'Feed/Stats.tpl.php') ?>

            </div>

        </div>
    </div>
</div>

<?php echo $savvy->render($context->media_list); ?>

<?php
$maintainers = $context->feed->getUserList();

$uids = array();
foreach ($maintainers->items as $maintainer) {
    $uid = htmlentities($maintainer->uid, ENT_QUOTES);
    $uids[] = '<a href="http://directory.unl.edu/people/'.$uid.'">'.$uid.'</a>';
}

?>

<div class="wdn-band wdn-light-neutral-band mh-channel-maintainers-list">
    <div class="wdn-inner-wrapper wdn-inner-padding-sm">
        <em>This channel is maintained by: <?php echo implode(', ', $uids); ?></em>
    </div>
</div>
