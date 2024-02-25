<?php
require_once __DIR__ . "/../bootstrap.php";
require_once __DIR__ . "/../nav/header.php";
?>
<main>
    <h2>Game Guide</h2>
    <h3>Welcome to the Proving Grounds</h3>
    <article class="gameGuide">
        <p>The game has grown a little bit since its first iteration.
            These days you get skillpoints and all sorts of things. Let's break it down!</p>
        <h4>- Character Stats -</h4>
        <p class="bold">[Hitpoints]</p>
        <p>Everyone knows what these are, they represent your life total. The beating heart.
            If you loose them all in battle your hero will perish. Actually die. Really, be careful.</p>
        <p>This game doesn't want you to die, but many of its monsters do and some hit hard.
            If you're up against unfamiliar enemies, play it safe until you know what's up.</p>
        <p>Lost hitpoints are regenerated over time, along with Grit, but if waiting around is not your thing then check the Healer's Hut.</p>
        <p class="bold">[Grit]</p>
        <p>Stamina, that's Grit. You can only engage in work or combat as long as you have sufficient Grit.
            It replenishes over time, if you run out give it a couple of minutes and well, you get more.</p>
        <p class="bold">[XP]</p>
        <p>Some say XP is why we play these games. To watch numbers go up. XP is your ticket to making numbers larger.
            By earning XP in combat your hero levels up and gets more skillpoints to spend. Fantastic!</p>
        <p class="bold">[Base Attributes - Strength]</p>
        <p>One of three base stats, strength represents the heroes raw power.
            Points spent increases both damage done and your maximum hitpoint-total.
            If hitting like an absolute truck is your jam, I say invest here while the market is hot.</p>
        <p class="bold">[Base Attributes - Speed]</p>
        <p>Speed governs a semi-hidden stat called "Fatigue" which determines how many turns your hero can fight in any single combat encounter.
            If your hero lacks the fatigue to continue the fight he or she will simply fold over and surrender.</p>
        <p>The speed attribute also influences the players Initiative, Evasion and Block skills. Making you slightly better at each one!</p>
        <p class="bold">[Base Attributes - Vitality]</p>
        <p>Vitality is health, good health and that means hitpoints. You won't get far around here without those. Make sure to drop points here along your journey.</p>
        <p class="bold">[Weapon Skills]</p>
        <p>Putting points here is very handy if you want to be able to hit things with your fancy weapons. A healthy weapon skill is needed both to overcome
            a specific weapons skill requirement aswell as to counteract enemies Evasion skill. Points well spent, seriously.</p>
        <p class="bold">[Skill - Initiative]</p>
        <p>Wanna go fast? First even? That's what initiative does. It decides which combatant gets to act first each turn.</p>
        <p class="bold">[Skill - Evasion]</p>
        <p>Evasion lets you dodge blows in combat, like take no damage. Who needs hitpoints now, huh? Counteracted by weapon skill level. Yes, monsters have those too!</p>
        <p class="bold">[Skill - Block]</p>
        <p>Sword and board! Hide behind a shield and reduce incoming damage. Pretty similar to Evasion,
            except it reduces damage based off of the equipped shield's damage reduction value.</p>

        <p class="bold">[Item Weight and Total Weight]</p>
        <p>As your hero gears up you might notice the Total Weight score increase. This is a measure of the heroes encumbrance.
            There's no upper limit to how much weight your hero can bear, however weight does negatively affect the skills Block, Evasion and Initiative. Making them less effective.
            This effect is not visible, except for well I mean.. you might start noticing you're not evading quite as much in combat as you used to.
        </p>
        <p>Compensate for added weight by investing more points into the affected skills.</p>

        <h4>- Combat -</h4>
        <p>Just a couple of things, not too much to divulge here.</p>

        <p class="bold">[Stances]</p>
        <p>When your hero enters a fight you get to choose one of three different stances. These affect your stats and skills in some way.</p>
        <p>Fast Attacks - Your hero favours quicker strikes and increased mobility. Gives a bonus to Initiative, Evasion and your chance to hit. Lowers your damage.</p>
        <p>Balanced - No seasoning. Your hero swings, dodges, blocks and does damage using unmodified values. A good baseline!</p>
        <p>Heavy Guard - Slow and punishing. You gain a bonus to Block and deal increased damage. However both Initiative and your chance to hit is reduced.</p>

        <p class="bold">[Critical hits]</p>
        <p>Just thought I'd throw this in here aswell. Both the player and the monsters you fight have a chance to critically strike, dealing increased damage. You have been warned!</p>

        <p>Last updated: 24/2-24</p>
    </article>
    <div class="combatImgContainer bottomImgTopMargin">
        <img src="<?= $baseURL; ?>/assets/images/goblin_fighter_sharp.png" />
    </div>
</main>
<?php
require_once __DIR__ . "/../nav/footer.php";
