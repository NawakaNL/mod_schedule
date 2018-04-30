<?php
// No direct access
defined('_JEXEC') or die; ?>
<div class="schedule">
  <div class="schedule-title">
    <i class="fas fa-calendar-alt"></i> Programma
  </div>
  <div class="schedule-content">
    <ul class="nav">
      <?PHP
      foreach ($grouped_events as $key=>$value) {
        if (date("Y-m-d", $value[0]->startDate/1000) == date("Y-m-d")) {
          echo "<li class=\"active\" id=\"activekey\">";
        } else {
          echo "<li>";
        }
         ?>
         <a data-toggle="pill" href="#<?PHP echo $value[0]->startDate; ?>"><?PHP echo $key; ?></a></li>
      <?PHP } ?>
    </ul>

    <div class="tab-content">
      <?PHP foreach ($grouped_events as $key=>$events) { ?>
        <div id="<?PHP echo $events[0]->startDate; ?>" class="<?PHP echo date("Y-m-d", $events[0]->startDate/1000) == date("Y-m-d") ? "active" : ""; ?> tab-pane fade in">
            <ul class="<?php echo $moduleclass_sfx; ?>">
              <?PHP foreach ($events as &$event) {
                if ($filter == "" || strpos($event->tag, $filter) !== false) {

                } else {
                  continue;
                }
                ?>
                <li itemscope itemtype="http://schema.org/Event" class="grid-wrapper">
                  <div class="event-date" itemprop="startDate" content="2013-09-14T21:30">Sat Sep 14</div>
                  <div class="event-date" itemprop="endDate" content="2013-09-14T23:30">Sat Sep 14</div>
                  <div class="event-time"><?PHP echo date('H:i', $event->startDate/1000 - 7200) . '-'. date('H:i', $event->endDate/1000 - 7200); ?></div>
                  <div class="event-description">
                    <div class="event-title" itemprop="name"><?PHP echo $event->title; ?></div>
                    <div class="event-location" itemprop="location"><?PHP echo $event->location; ?></div>
                    <!-- Labels -->
                    <div class="labels">
                      <?PHP
                      foreach(explode(",", $event->tag) as $tag){
                      ?>
                      <span class="label label-<?PHP echo $tag;?>"><?PHP echo $tag;?></span>
                      <?PHP } ?>
                    </div>
                  </div>
                  <div class="clearfix"></div>
          			</li>
              <?PHP } ?>
            </ul>
        </div>
      <?PHP } ?>
    </div>
    <script>
    console.log($('li.active').position());
    $('ul.nav').animate({scrollLeft: $('li.active').position().left}, 500);
    </script>
  </div>
</div>
