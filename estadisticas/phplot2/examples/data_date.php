<?php
//Title,unixtime_date,value

$example_data = array(
	array("Jan",883634400,10),
	array("",883720800,20),
	array("",883807200,20),
	array("",883893600,22),
	array("",883980000,33),
	array("",884239200,30),
	array("",884325600,20),
	array("",884412000,10),
	array("",884498400,11),
	array("",884584800,42),
	array("",884844000,21),
	array("",884930400,42),
	array("",885016800,43),
	array("",885103200,24),
	array("",885189600,55),
	array("",885448800,28),
	array("",885535200,39),
	array("",885621600,20),
	array("",885708000,41),
	array("",885967200,34),
	array("",886053600,45),
	array("",886140000,56),
	array("",886226400,27),
	array("Feb",886312800,28),
	array("",886572000,31),
	array("",886658400,32),
	array("",886744800,33),
	array("",886831200,34),
	array("",886917600,35),
	array("",887176800,38),
	array("",887263200,39),
	array("",887349600,40),
	array("",887436000,41),
	array("",887522400,42),
	array("",887781600,45),
	array("",887868000,46),
	array("",887954400,47),
	array("",888040800,48),
	array("",888127200,49),
	array("",888386400,52),
	array("",888472800,53),
	array("",888559200,54),
	array("",888645600,55),
	array("Mar",888732000,56),
	array("",888991200,59),
	array("",889077600,60),
	array("",889164000,61),
	array("",889250400,62),
	array("",889336800,63),
	array("",889596000,66),
	array("",889682400,67),
	array("",889768800,68),
	array("",889855200,69),
	array("",889941600,70),
	array("",890200800,33),
	array("",890287200,34),
	array("",890373600,35),
	array("",890460000,36),
	array("",890546400,37),
	array("",890805600,30),
	array("",890892000,31),
	array("",890978400,32),
	array("",891064800,33),
	array("",891151200,34),
	array("",891410400,37),
	array("",891496800,38),
	array("",891583200,10),
	array("",891669600,12),
	array("",891756000,14),
	array("",892015200,20),
	array("",892101600,22),
	array("",892188000,24),
	array("",892274400,26),
	array("",892360800,28),
	array("",892620000,34),
	array("",892706400,36),
	array("",892792800,38),
	array("",892879200,40),
	array("",892965600,42),
	array("",893224800,48),
	array("",893311200,50),
	array("",893397600,52),
	array("",893484000,54),
	array("",893570400,56),
	array("",893829600,62),
	array("",893916000,64),
	array("",894002400,66),
	array("",894088800,68),
	array("",894175200,60),
	array("",894434400,66),
	array("",894520800,68),
	array("",894607200,60),
	array("",894693600,62),
	array("",894780000,64),
	array("",895039200,60),
	array("",895125600,62),
	array("",895212000,64),
	array("",895298400,66),
	array("",895384800,68),
	array("",895644000,10),
	array("",895730400,06),
	array("",895816800,08),
	array("",895903200,11),
	array("",895989600,11),
	array("",896248800,18),
	array("",896335200,20),
	array("",896421600,12),
	array("",896508000,12),
	array("",896594400,10),
	array("",896853600,13),
	array("",896940000,14),
	array("",897026400,15),
	array("",897112800,16),
	array("",897199200,17),
	array("",897458400,20),
	array("",897544800,21),
	array("",897631200,22),
	array("",897717600,23),
	array("",897804000,24),
	array("",898063200,27),
	array("",898149600,28),
	array("",898236000,29),
	array("",898322400,30),
	array("",898408800,31),
	array("",898668000,34),
	array("",898754400,35),
	array("",898840800,36),
	array("",898927200,37),
	array("",899013600,38),
	array("",899272800,41),
	array("",899359200,42),
	array("",899445600,43),
	array("",899532000,44),
	array("",899618400,45),
	array("",899877600,48),
	array("",899964000,49),
	array("",900050400,50),
	array("",900136800,21),
	array("",900223200,62),
	array("",900482400,35),
	array("",900568800,76),
	array("",900655200,37),
	array("",900741600,78),
	array("",900828000,49),
	array("",901087200,82),
	array("",901173600,23),
	array("",901260000,44),
	array("",901346400,55),
	array("",901432800,26),
	array("",901692000,49),
	array("",901778400,10),
	array("",901864800,51),
	array("",901951200,52),
	array("",902037600,53),
	array("",902296800,46),
	array("",902383200,47),
	array("",902469600,68),
	array("",902556000,69),
	array("",902642400,40),
	array("",902901600,73),
	array("",902988000,84),
	array("",903074400,85),
	array("",903160800,86),
	array("",903247200,87),
	array("",903506400,40),
	array("",903592800,21),
	array("",903679200,52),
	array("",903765600,83),
	array("",903852000,24),
	array("",904111200,27),
	array("",904197600,68),
	array("",904284000,49),
	array("",904370400,10),
	array("",904456800,01),
	array("",904716000,14),
	array("",904802400,10),
	array("",904888800,16),
	array("",904975200,07),
	array("",905061600,18),
	array("",905320800,12),
	array("",905407200,14),
	array("",905493600,16),
	array("",905580000,18),
	array("",905666400,20),
	array("",905925600,26),
	array("",906012000,28),
	array("",906098400,30),
	array("",906184800,32),
	array("",906271200,34),
	array("",906530400,40),
	array("",906616800,42),
	array("",906703200,44),
	array("",906789600,46),
	array("",906876000,48),
	array("",907135200,54),
	array("",907221600,56),
	array("",907308000,58),
	array("",907394400,60),
	array("",907480800,62),
	array("",907740000,68),
	array("",907826400,70),
	array("",907912800,72),
	array("",907999200,74),
	array("",908085600,76),
	array("",908344800,32),
	array("",908431200,44),
	array("",908517600,46),
	array("",908604000,28),
	array("",908690400,60),
	array("",908949600,36),
	array("",909036000,58),
	array("",909122400,70),
	array("",909208800,22),
	array("",909295200,54),
	array("",909554400,30),
	array("",909640800,52),
	array("",909727200,34),
	array("",909813600,56),
	array("",909900000,38),
	array("",909986400,60),
	array("",910245600,42),
	array("",910332000,53),
	array("",910418400,54),
	array("",910504800,35),
	array("",910591200,46),
	array("",910850400,49),
	array("",910936800,40),
	array("",911023200,32),
	array("",911109600,22),
	array("",911196000,23),
	array("",911455200,26),
	array("",911541600,27),
	array("",911628000,28),
	array("",911714400,29),
	array("",911800800,30),
	array("",912060000,33),
	array("",912146400,34),
	array("",912232800,35),
	array("",912319200,36),
	array("",912405600,37),
	array("Dec",912664800,40),
	array("",912751200,41),
	array("",912837600,42),
	array("",912924000,43),
	array("",913010400,44),
	array("",913269600,47),
	array("",913356000,48),
	array("",913442400,49),
	array("",913528800,50),
	array("",913615200,51),
	array("",913874400,54),
	array("",913960800,55),
	array("",914047200,56),
	array("",914133600,57),
	array("",914220000,58),
	array("",914479200,61),
	array("",914565600,62),
	array("",914652000,63),
	array("",914738400,64),
	array("",914824800,65),
	array("",915084000,68)
);
?>
