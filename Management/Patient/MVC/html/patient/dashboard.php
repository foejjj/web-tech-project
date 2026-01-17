<?php
$title = "Patient Dashboard";
include MVC_PATH . '/html/partials/head.php';
include MVC_PATH . '/html/partials/topbar.php';
?>
<div class="layout">
  <?php include MVC_PATH . '/html/partials/sidebar.php'; ?>

  <div class="content">
    <div class="greetingRow">
      <div class="wave">👋</div>
      <div class="greetText">Good Afternoon</div>
    </div>

    <h1 class="pageTitle">Patient Dashboard</h1>

    <?php if ($m = flash_get('success')): ?>
      <div class="alert success"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>
    <?php if ($m = flash_get('error')): ?>
      <div class="alert error"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>

    <div class="cardsGrid">
      <div class="card">
        <div class="cardNum">1</div>
        <div class="cardBody">
          <div class="cardTitle">Upcoming Appointments</div>
          <div class="cardMeta"><?= (int)$data['upcomingCount'] ?> Scheduled</div>

          <div class="cardSmall">Next appointment coming up</div>
          <?php if ($data['nextAppt']): ?>
            <div class="apptLine">📅 <?= htmlspecialchars($data['nextAppt']['date']) ?> - <?= htmlspecialchars($data['nextAppt']['time']) ?></div>
            <div class="apptLineMuted">Dr. <?= htmlspecialchars($data['nextAppt']['doctor_name']) ?></div>
          <?php else: ?>
            <div class="apptLineMuted">No upcoming appointment</div>
          <?php endif; ?>

          <div class="cardLinkRow">
            <a class="link" href="index.php?r=book_appointment">Book appointment</a>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="cardNum">2</div>
        <div class="cardBody">
          <div class="cardTitle">Active Prescriptions</div>
          <div class="cardMeta"><?= (int)$data['activeRxCount'] ?> Medications</div>
          <div class="cardLinkRow">
            <a class="link" href="index.php?r=download_latest_prescription">Download Prescription</a>
            <a class="link muted" href="index.php?r=prescriptions">View all</a>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="cardNum">3</div>
        <div class="cardBody">
          <div class="cardTitle">Recent Test Reports</div>
          <div class="cardMeta"><?= (int)$data['recentTestsCount'] ?> New Result</div>
          <div class="cardLinkRow">
            <span class="link muted">Download Latest Test Result</span>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="cardNum">4</div>
        <div class="cardBody">
          <div class="cardTitle">Total Medical History</div>
          <div class="cardMeta"><?= (int)$data['historyVisitsCount'] ?> Visits</div>
          <div class="cardLinkRow">
            <span class="link muted">Download latest medical history</span>
          </div>
        </div>
      </div>
    </div>

    <div class="illustrationWrap">
      <img class="illustration" src="images/patient_illustration.svg" alt="illustration"/>
    </div>
  </div>
</div>
<?php include MVC_PATH . '/html/partials/footer.php'; ?>
