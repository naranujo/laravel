<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Section;

class HomeController extends Controller
{
    public function index() {
        $lang = $_GET['lang'] ?? 'es';

        $title = array(
            'es' => 'Inicio',
            'en' => 'Home',
            'pt' => 'Início',
        );

        $title = $title[$lang];

        $description = array(
            'es' => 'Bienvenido a la página de inicio',
            'en' => 'Welcome to the home page',
            'pt' => 'Bem-vindo à página inicial',
        );

        $description = $description[$lang];

        $template="default";

        $title0 = array(
            'es' => 'Inicio',
            'en' => 'Home',
            'pt' => 'Início',
        );

        $title1 = array(
            'es' => 'Nosotros',
            'en' => 'About us',
            'pt' => 'Sobre nós',
        );

        $title2 = array(
            'es' => 'Clientes',
            'en' => 'Clients',
            'pt' => 'Clientes',
        );

        $title3 = array(
            'es' => 'Servicios',
            'en' => 'Services',
            'pt' => 'Serviços',
        );

        $title4 = array(
            'es' => 'Contacto',
            'en' => 'Contact',
            'pt' => 'Contato',
        );

        $title5 = array(
            'es' => 'Novedades',
            'en' => 'News',
            'pt' => 'Notícias',
        );

        $animleft  = ' data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="3000" ';
        $animright = ' data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1000" ';

        $slider = array(
            'es' => 'SOBRE NOSOTROS',
            'en' => 'ABOUT US',
            'pt' => 'SOBRE NÓS',
        );

        $slider_boton = array(
            'es' => 'SEGUIR LEYENDO',
            'en' => 'READ MORE',
            'pt' => 'LEIA MAIS',
        );

        $slide1_tit = array(
            'es' => 'Independencia: <br class="d-none d-md-block">comprometidos únicamente <br class="d-none d-md-block">con nuestros clientes',
            'en' => 'Independence: <br class="d-none d-md-block">we are entirely committed <br class="d-none d-md-block">to our clients.',
            'pt' => 'Independência: <br class="d-none d-md-block">totalmente comprometidos <br class="d-none d-md-block">com nossos clientes.',
        );

        $slide1_tex = array(
            'es' => 'Brindamos un asesoramiento objetivo, libre de restricciones, solo alineado con los intereses de quienes nos eligen.',
            'en' => 'We offer objective, unrestricted consulting, aligned solely with the interests of those who choose to engage us.',
            'pt' => 'Oferecemos consultoria objetiva e sem restrições, alinhada exclusivamente com os interesses daqueles que escolhem nos contratar.',
        );

        $slide2_tit = array(
            'es' => 'Enfoque global: <br class="d-none d-md-block">abordamos los desafíos <br class="d-none d-md-block">de la ingeniería patrimonial <br class="d-none d-md-block">de manera integrada ',
            'en' => 'Global focus: <br class="d-none d-md-block">we approach the challenges <br class="d-none d-md-block">of wealth engineering <br class="d-none d-md-block">in an integrated manner.',
            'pt' => 'Foco global: <br class="d-none d-md-block">abordamos os desafios <br class="d-none d-md-block">da engenharia patrimonial <br class="d-none d-md-block">de forma integrada.',
        );

        $slide2_tex = array(
            'es' => 'Ofrecemos soluciones que comprenden la planificación patrimonial, la planificación fiscal y la gestión y protección de activos.',
            'en' => 'We provide solutions that encompass wealth and fiscal planning, as well as the management and protection of assets.',
            'pt' => 'Oferecemos soluções que abrangem planejamento patrimonial, planejamento fiscal e gestão e proteção de ativos.',
        );

        $slide3_tit = array(
            'es' => 'Escala humana: <br class="d-none d-md-block">cercanía y franqueza <br class="d-none d-md-block">para gestar relaciones<br class="d-none d-md-block"> sólidas y duraderas',
            'en' => 'Human scale: <br class="d-none d-md-block">proximity and openness <br class="d-none d-md-block">to create solid and lasting <br class="d-none d-md-block">working relationships',
            'pt' => 'Escala humana: <br class="d-none d-md-block">proximidade e franqueza <br class="d-none d-md-block">para criar relacionamentos <br class="d-none d-md-block">sólidos e duradouros',
        );

        $slide3_tex = array(
            'es' => 'El trato personalizado y el conocimiento mutuo son esenciales para nutrir la confianza que sostiene nuestro negocio.',
            'en' => 'Personalized services and getting to know each other are paramount to nurture/the trust that upholds our business.',
            'pt' => 'Serviços personalizados e conhecer uns aos outros são fundamentais para nutrir a confiança que sustenta nosso negócio.',
        );

        $slide4_tit = array(
            'es' => 'Profesionalismo: formación <br class="d-none d-md-block">académica y capacitación <br class="d-none d-md-block">continua para brindar <br class="d-none d-md-block">soluciones de vanguardia',
            'en' => 'Professionalism: academic <br class="d-none d-md-block">background and continuous <br class="d-none d-md-block">training to deliver <br class="d-none d-md-block">avant-garde solutions',
            'pt' => 'Profissionalismo: formação <br class="d-none d-md-block">acadêmica e treinamento <br class="d-none d-md-block">contínuo para oferecer <br class="d-none d-md-block">soluções de ponta',
        );

        $slide4_tex = array(
            'es' => 'Un equipo de expertos altamente calificados, personalmente comprometidos con la transparencia y los estándares éticos más elevados.',
            'en' => 'A team of highly qualified experts, each committed to transparency and the highest ethical standards.',
            'pt' => 'Uma equipe de especialistas altamente qualificados, comprometidos pessoalmente com a transparência e os mais altos padrões éticos.',
        );

        $seccion1 = array(
            'es' => 'NOSOTROS',
            'en' => 'ABOUT US',
            'pt' => 'SOBRE NÓS',
        );

        $seccion1_tit = array(
            'es' => 'Un equipo apasionado, <br>una firma con alma',
            'en' => 'An impassioned team, <br>a firm with soul',
            'pt' => 'Uma equipe apaixonada, <br>uma empresa com alma',
        );

        $seccion1_tex1 = array(
            'es' => 'En Greenock somos profundamente conscientes de la delicada misión que implica resguardar los frutos de su esfuerzo para asegurar su trascendencia en el tiempo y su transmisión a las siguientes generaciones. Por eso trabajamos de manera rigurosa e incansable para honrar la confianza que implica ser elegidos para llevar adelante una tarea tan significativa.',
            'en' => 'At Greenock we are profoundly aware of the delicacy required by the mission of safeguarding the fruits of your labour in order to ensure its preservation and transmission to future generations. That is why we work meticulously and tirelessly to honor the trust that comes with being selected to carry out such a significant task.',
            'pt' => 'Na Greenock, estamos profundamente conscientes da delicada missão de proteger os frutos do seu trabalho para garantir sua transcendência ao longo do tempo e sua transmissão para as próximas gerações. Por isso, trabalhamos de forma rigorosa e incansável para honrar a confiança que vem com a escolha de realizar uma tarefa tão significativa.',
        );

        $seccion1_tex2 = array(
            'es' => 'Conformamos un equipo de profesionales altamente capacitados en materia legal, fiscal y de auditoría financiera, en el que convergen más de 100 años de experiencia combinada en planificación patrimonial, trayectorias reconocidas internacionalmente y el dinamismo y la frescura de una compañía joven e innovadora, cuya escala compacta propicia una gestión ágil y eficaz, con mínimos niveles de delegación y un compromiso total con la confidencialidad.',
            'en' => 'We make up a team of highly trained professionals in matters of legal, fiscal and financial auditing, with a combined 100 years of experience in wealth planning and international recognition. We also bring to the table the dynamism and vitality of a young and innovative firm, helped by our scale to achieve rapid and efficient management, with minimal delegating and a total commitment to confidentiality.',
            'pt' => 'Formamos uma equipe de profissionais altamente capacitados em questões legais, fiscais e auditoria financeira, com mais de 100 anos de experiência combinada em planejamento patrimonial e reconhecimento internacional. Também trazemos para a mesa o dinamismo e a vitalidade de uma empresa jovem e inovadora, ajudada pela nossa escala para alcançar uma gestão rápida e eficiente, com delegação mínima e um compromisso total com a confidencialidade.',
        );

        $seccion1_tex3 = array(
            'es' => 'Somos una firma boutique, cuyos máximos responsables participan activamente en la operación diaria y están personalmente involucrados en la relación que en Greenock mantenemos con cada uno de nuestros clientes y sus familias. Porque sus intereses constituyen nuestra mayor prioridad y son la referencia de una labor que realizamos con prudencia y transparencia, libre de todo tipo de condicionamiento externo gracias al carácter independiente de nuestra compañía.',
            'en' => 'We are a boutique firm where the top officers participate actively in the day-to-day operations and are personally involved in the relationships we at Greenock maintain with each and every client and their families. Because their interests are our top priority and referral point to a task we carry out with discretion and transparency, free of external conditioning factors, all of which is made possible by the independent nature of our company.',
            'pt' => 'Somos uma empresa boutique, onde os principais executivos participam ativamente das operações diárias e estão pessoalmente envolvidos nos relacionamentos que mantemos na Greenock com cada cliente e suas famílias. Porque seus interesses são nossa maior prioridade e ponto de referência para uma tarefa que realizamos com discrição e transparência, livre de condicionamentos externos, tudo isso é possível graças à natureza independente de nossa empresa.',
        );

        $seccion2 = array(
            'es' => 'METODOLOGÍA',
            'en' => 'METHODOLOGY',
            'pt' => 'METODOLOGIA',
        );

        $seccion2_tit = array(
            'es' => 'Conocernos para confiar, <br>confiar para creer',
            'en' => 'Getting to know us to trust, <br>trust to believe',
            'pt' => 'Conhecer-nos para confiar, <br>confiar para acreditar',
        );

        $seccion2_tex1 = array(
            'es' => 'En Greenock sabemos que el factor más determinante a la hora de constituir y asignar la administración de un fondo fiduciario es la confianza. Entendemos que inspirarla depende de nuestra conducta, tanto corporativa como personal, y que cultivarla es una tarea que requiere minuciosidad y constancia. Por eso nos dedicamos a brindar una atención personalizada, caracterizada por la comunicación fluida, la disponibilidad inmediata y el diálogo sincero con cada cliente y su entorno familiar.',
            'en' => 'At Greenock we know that trust is the decisive factor when it comes to establishing and assigning the management of a trust fund. We understand that inspiring that trust depends on our conduct, both personal and corporate, and that cultivating trust is an endeavor that requires thoroughness and steadiness. For this reason, we are dedicated to offering customized services, marked by smooth communication, immediate accessibility, and forthright conversations with each client and their family.',
            'pt' => 'Na Greenock, sabemos que a confiança é o fator decisivo na hora de estabelecer e atribuir a gestão de um fundo fiduciário. Entendemos que inspirar essa confiança depende de nossa conduta, tanto pessoal quanto corporativa, e que cultivar a confiança é uma tarefa que requer minúcia e constância. Por isso, estamos dedicados a oferecer serviços personalizados, marcados por uma comunicação fluida, acessibilidade imediata e conversas francas com cada cliente e sua família.',
        );

        $seccion2_tex2 = array(
            'es' => 'La relación próxima y franca que establecemos con quienes nos eligen nos posibilita indagar en sus deseos, identificar sus inquietudes e interpretar sus expectativas. De esa manera, podemos dar respuestas específicas y a la medida de cada familia a partir de meticulosos análisis y evaluaciones. Porque nuestra escala y el nivel de eficiencia de nuestros procesos nos permiten prescindir de las soluciones estandarizadas en el desarrollo y la gestión de estrategias fiduciarias.',
            'en' => 'The close and sincere rapport we establish with everyone that chooses to engage our services allows us to explore their wishes, identify their concerns and interpret their expectations. In this way, we can provide specific and customized solutions through meticulous assessments and evaluations. Due to our scale and level of efficiency of our process, we can dispense with standardized solutions when addressing the development and managing of fiduciary strategies.',
            'pt' => 'O relacionamento próximo e sincero que estabelecemos com aqueles que nos escolhem nos permite explorar seus desejos, identificar suas preocupações e interpretar suas expectativas. Dessa forma, podemos fornecer soluções específicas e personalizadas por meio de avaliações meticulosas. Devido à nossa escala e nível de eficiência de nosso processo, podemos dispensar soluções padronizadas ao abordar o desenvolvimento e a gestão de estratégias fiduciárias.',
        );

        $seccion2_tex3 = array(
            'es' => 'Nuestro liderazgo se basa en la formación académica de nuestros profesionales, en nuestra solvencia en la emisión de reportes, en el dinamismo de nuestros controles internos y en un exhaustivo monitoreo de activos y actividades dentro de cada fideicomiso. Son los procesos que dan cuenta de la responsabilidad y el profesionalismo con los que llevamos adelante el resguardo de los patrimonios que nos son confiados.',
            'en' => 'Our leadership is based on the academic qualifications of our professionals, on the dependability of the reports we issue, on the dynamism of our internal controls, and on the exhaustive monitoring of assets and activities within each trust. These are the processes that attest to the responsibility and professionalism with which we conduct the safeguarding of all assets we are entrusted.',
            'pt' => 'Nossa liderança é baseada na formação acadêmica de nossos profissionais, na confiabilidade dos relatórios que emitimos, na dinâmica de nossos controles internos e no monitoramento exaustivo de ativos e atividades dentro de cada fideicomisso. Esses são os processos que atestam a responsabilidade e o profissionalismo com os quais conduzimos a proteção de todos os ativos que nos são confiados.',
        );

        $seccion3 = array(
            'es' => 'CLIENTES',
            'en' => 'CLIENTS',
            'pt' => 'CLIENTES',
        );

        $seccion3_tit = array(
            'es' => 'Tradición, valores e identidad,<br>el patrimonio más preciado',
            'en' => 'Tradition, values and identity, <br>the most treasured assets',
            'pt' => 'Tradição, valores e identidade, <br>o patrimônio mais precioso',
        );

        $seccion3_tex1 = array(
            'es' => 'Los servicios fiduciarios que ofrece Greenock están destinados a individuos y familias de alto patrimonio. Se trata de un círculo de clientes tan selectos como exigentes, habituados a obtener prestaciones de excelencia y un trato único. Por eso buscamos forjar con cada uno de ellos y sus familias un vínculo en el que confluyen tanto profesionalismo y calidez, como integridad y la más absoluta discreción.',
            'en' => 'The fiduciary services Greenock provides are aimed at high-net-worth individuals and families. They make up a group of select and demanding clients, accustomed to obtaining excelling performances and tailored solutions. For this reason, we set out to forge a strong bond with each client and their family, combining professionalism and warmth, as well as integrity and complete discretion.',
            'pt' => 'Os serviços fiduciários oferecidos pela Greenock são destinados a indivíduos e famílias de alto patrimônio. Eles compõem um grupo de clientes selecionados e exigentes, acostumados a obter desempenho excelente e soluções personalizadas. Por esse motivo, buscamos estabelecer um vínculo forte com cada cliente e sua família, combinando profissionalismo e cordialidade, assim como integridade e total discrição.',
        );

        $seccion3_tex2 = array(
            'es' => 'Quienes requieren nuestro asesoramiento se destacan por ser conscientes de su legado y haber asumido con una profunda generosidad y visión de largo plazo la responsabilidad de planificar el destino y la evolución de su patrimonio para asegurar el bienestar de sus herederos.',
            'en' => 'Those who choose to request our services are usually conscious of their legacy and have taken on that responsibility with generosity and long-term vision to plan the future and evolution of their assets in order to secure the well-being of the subsequent generations.',
            'pt' => 'Aqueles que escolhem solicitar nossos serviços geralmente estão conscientes de seu legado e assumiram essa responsabilidade com generosidade e visão de longo prazo para planejar o futuro e a evolução de seus ativos, a fim de garantir o bem-estar das gerações subsequentes.',
        );

        $seccion3_tex3 = array(
            'es' => 'Gracias a nuestra vasta experiencia en ingeniería patrimonial y a nuestra capacitación continua, contamos con la sensibilidad, la sagacidad y el conocimiento necesarios para asignar a cada patrimonio el orden y la estructura que mejor se adapte a los objetivos y las aspiraciones de cada individuo y familia. Y una vez que el plan elaborado está en marcha, permanecemos junto a nuestros clientes para ayudarlos en la toma de decisiones —de las más importantes y complejas a las más pequeñas— y, como mediadores entre generaciones, estimulamos el compromiso de los más jóvenes para con la tradición y el legado familiar.',
            'en' => 'Due to our vast experience in the field of wealth engineering and our continuous training program, we possess the sensibility, acumen and knowledge needed to provide the order and structuring each wealth demands to better adapt to the goals and aspirations of each individual and family. Once that plan has been set in motion, we stand by our clients to assist them in the decision-making process—from the most complex and important to the smallest of issues—and we function as mediators between the generations, while encouraging the younger members to commit to the family traditions and legacy.',
            'pt' => 'Devido à nossa vasta experiência no campo da engenharia patrimonial e ao nosso programa de treinamento contínuo, possuímos a sensibilidade, perspicácia e conhecimento necessários para fornecer a ordem e a estrutura que cada patrimônio exige para se adaptar melhor aos objetivos e aspirações de cada indivíduo e família. Uma vez que esse plano foi colocado em prática, estamos ao lado de nossos clientes para ajudá-los no processo de tomada de decisão - desde as mais complexas e importantes até as menores questões - e atuamos como mediadores entre as gerações, incentivando os membros mais jovens a se comprometerem com as tradições e o legado familiar.',
        );

        $seccion4 = array(
            'es' => 'TRUST',
            'en' => 'TRUST',
            'pt' => 'TRUST',
        );

        $seccion4_tit = array(
            'es' => 'Un instrumento que es historia, <br>y también futuro',
            'en' => 'An instrument of the past <br>as much as of the future',
            'pt' => 'Um instrumento do passado <br>tanto quanto do futuro',
        );

        $seccion4_tex1 = array(
            'es' => 'Un trust es un negocio jurídico privado que consiste en la transmisión de bienes o derechos de una persona (el constituyente) a otra (el fiduciario) para que esta los administre en nombre de la primera y en beneficio de un tercero o terceros (los beneficiarios).',
            'en' => 'A trust is a private legal business that allows the transfer of assets or rights of a party (the trustor) to another party (the trustee) to hold and direct said assets on their behalf for the benefit of a third party (the beneficiary or beneficiaries).',
            'pt' => 'Um trust é um negócio jurídico privado que consiste na transferência de bens ou direitos de uma pessoa (o constituinte) para outra (o fiduciário) para que este administre em nome do primeiro e em benefício de um terceiro ou terceiros (os beneficiários).',
        );

        $seccion4_tex2 = array(
            'es' => 'Los orígenes de este instrumento —de raíz anglosajona— se remontan a las cruzadas. En esa época, los señores feudales se lanzaban a una guerra muy lejana y su regreso era definitivamente muy incierto. Por eso, con una actitud previsora, muchos de ellos entregaban su patrimonio a una persona de su máxima confianza para de esa manera garantizar el futuro de sus allegados.',
            'en' => 'The origins of this instrument—of Anglo-Saxon roots—date back to the Crusades. In those days, the feudal lords left to fight a war far away and their return was decidedly uncertain. That is why, with a proactive attitude, many of them put their wealth in the hands of a person of their utmost trust to secure the future of their kin.',
            'pt' => 'As origens desse instrumento - de raízes anglo-saxônicas - remontam às Cruzadas. Naquela época, os senhores feudais partiam para uma guerra distante e seu retorno era definitivamente incerto. Por isso, com uma atitude proativa, muitos deles entregavam sua riqueza nas mãos de uma pessoa de sua máxima confiança para garantir o futuro de seus familiares.',
        );

        $seccion4_tex3 = array(
            'es' => 'Un milenio más tarde, este recurso ha evolucionado y ha sido dotado de rigurosos marcos legales en diversas jurisdicciones alrededor del mundo. Y, al igual que en la Edad Media, sigue siendo una valiosa herramienta para anticiparse a cualquier eventualidad, acotar la incertidumbre y asegurar un horizonte para nuestros seres más queridos.',
            'en' => 'A millennium later, this vehicle has evolved and received strict legal frameworks in different jurisdictions around the world. And, much like in the Middle Ages, it still proves to be a useful resource to anticipate any eventuality, reduce uncertainty and safeguard the future of our loved ones.',
            'pt' => 'Milênios depois, esse instrumento evoluiu e recebeu estruturas legais rigorosas em diferentes jurisdições ao redor do mundo. E, assim como na Idade Média, ainda se mostra um recurso útil para antecipar qualquer eventualidade, reduzir a incerteza e garantir o futuro de nossos entes queridos.',
        );

        $seccion5 = array(
            'es' => 'SERVICIOS',
            'en' => 'SERVICES',
            'pt' => 'SERVIÇOS',
        );

        $seccion5_tit = array(
            'es' => 'Soluciones de excelencia, <br>sustentadas en nuestro liderazgo <br>y en nuestra experiencia',
            'en' => 'World-class solutions, sustained by our leadership skills and experience',
            'pt' => 'Soluções de excelência, sustentadas em nossa liderança e experiência',
        );

        $seccion5_item1 = array(
            'es' => 'PLANIFICACIÓN',
            'en' => 'PLANNING',
            'pt' => 'PLANEJAMENTO',
        );

        $seccion5_item1_txt1 = array(
            'es' => 'Planificación patrimonial, sucesoria y protección de activos.',
            'en' => 'Estate planning, succession, and asset protection.',
            'pt' => 'Planejamento patrimonial, sucessório e proteção de ativos.',
        );

        $seccion5_item2 = array(
            'es' => 'SERVICIOS FIDUCIARIOS',
            'en' => 'FIDUCIARY SERVICES',
            'pt' => 'SERVIÇOS FIDUCIÁRIOS',
        );

        $seccion5_item2_txt1 = array(
            'es' => 'Estructuración, incorporación, administración y monitoreo de Trusts en diversas jurisdicciones internacionales',
            'en' => 'Structuring, incorporation, administration, and monitoring of trusts in various international jurisdictions',
            'pt' => 'Estruturação, incorporação, administração e monitoramento de trusts em diversas jurisdições internacionais',
        );

        $seccion5_item3 = array(
            'es' => 'ADMINISTRACIÓN DE ACTIVOS COMPLEJOS',
            'en' => 'COMPLEX ASSET MANAGEMENT',
            'pt' => 'ADMINISTRAÇÃO DE ATIVOS COMPLEXOS',
        );

        $seccion5_item3_txt1 = array(
            'es' => 'Servicios de gestión de fondos familiares, inmuebles y obras de arte',
            'en' => 'Family fund management services, real estate, and art collections',
            'pt' => 'Serviços de gestão de fundos familiares, imóveis e obras de arte',
        );

        $seccion5_item3_txt2 = array(
            'es' => 'Control de la gobernabilidad de los negocios familiares',
            'en' => 'Control of family business governance',
            'pt' => 'Controle da governança dos negócios familiares',
        );

        $seccion5_item3_txt3 = array(
            'es' => 'Servicios calificados de custodia de activos digitales, como criptomonedas y valores digitales',
            'en' => 'Qualified custody services for digital assets, such as cryptocurrencies and digital securities',
            'pt' => 'Serviços qualificados de custódia de ativos digitais, como criptomoedas e valores digitais',
        );

        $seccion5_item4 = array(
            'es' => 'SERVICIOS DE FAMILY OFFICE',
            'en' => 'FAMILY OFFICE SERVICES',
            'pt' => 'SERVIÇOS DE FAMILY OFFICE',
        );

        $seccion5_item4_txt1 = array(
            'es' => 'Servicios de asesoramiento para la estructuración de un family office y gestión de patrimonios familiares',
            'en' => 'Advisory services for structuring a family office and managing family wealth',
            'pt' => 'Serviços de consultoria para estruturação de um family office e gestão de patrimônios familiares',
        );

        $seccion5_item5 = array(
            'es' => 'FONDOS PRIVADOS',
            'en' => 'PRIVATE FUNDS',
            'pt' => 'FUNDOS PRIVADOS',
        );

        $seccion5_item5_txt1 = array(
            'es' => 'Constitución y administración de fondos privados, y prestación de servicios de cumplimiento',
            'en' => 'Constitution and administration of private funds, and provision of compliance services',
            'pt' => 'Constituição e administração de fundos privados, e prestação de serviços de conformidade',
        );

        $seccion5_item5_txt2 = array(
            'es' => 'Cálculo de NAV (Net Asset Value)',
            'en' => 'Calculation of NAV (Net Asset Value)',
            'pt' => 'Cálculo do NAV (Valor Líquido do Ativo)',
        );

        $seccion5_item6 = array(
            'es' => 'ÉTICA Y CUMPLIMIENTO',
            'en' => 'ETHICS AND COMPLIANCE',
            'pt' => 'ÉTICA E CONFORMIDADE',
        );

        $seccion5_item6_txt1 = array(
            'es' => 'Preparación de reportes y clasificación conforme normas de CRS, FATCA & CTA',
            'en' => 'Preparation of reports and classification according to CRS, FATCA & CTA regulations',
            'pt' => 'Preparação de relatórios e classificação de acordo com as regulamentações CRS, FATCA & CTA',
        );
        $seccion5_item6_txt2 = array(
            'es' => 'Confección de reportes de Erosión de la base imponible y traslado de beneficios (BEPS)',
            'en' => 'Preparation of reports on Base Erosion and Profit Shifting (BEPS)',
            'pt' => 'Preparação de relatórios sobre Erosão da Base Tributável e Transferência de Lucros (BEPS)',
        );
        $seccion5_item6_txt3 = array(
            'es' => 'Preparación y presentación de reportes de sustancia económica de acuerdo a la normativa de cada jurisdicción',
            'en' => 'Preparation and submission of reports on economic substance in accordance with the regulations of each jurisdiction',
            'pt' => 'Preparação e apresentação de relatórios sobre substância econômica de acordo com as regulamentações de cada jurisdição',
        );

        $seccion5_item7 = array(
            'es' => 'TERCERIZACIÓN DE SERVICIOS',
            'en' => 'OUTSOURCING SERVICES',
            'pt' => 'TERCEIRIZAÇÃO DE SERVIÇOS',
        );

        $seccion5_item7_txt1 = array(
            'es' => 'Preparación de estados contables',
            'en' => 'Preparation of financial statements',
            'pt' => 'Preparação de demonstrações financeiras',
        );

        $seccion5_item7_txt2 = array(
            'es' => 'Elaboración de reportes periodicos de gestión financiera para familias y negocios',
            'en' => 'Preparation of periodic financial management reports for families and businesses',
            'pt' => 'Preparação de relatórios periódicos de gestão financeira para famílias e negócios',
        );

        $seccion5_item7_txt3 = array(
            'es' => 'Confección y presentación de reportes impositivos ante autoridades fiscales',
            'en' => 'Preparation and submission of tax reports to tax authorities',
            'pt' => 'Preparação e apresentação de relatórios fiscais às autoridades fiscais',
        );

        $seccion5_item8 = array(
            'es' => 'SERVICIOS EN URUGUAY',
            'en' => 'SERVICES IN URUGUAY',
            'pt' => 'SERVIÇOS NO URUGUAY',
        );

        $seccion5_item8_txt1 = array(
            'es' => 'Asesoramiento y gestión de residencias fiscales y legales',
            'en' => 'Advisory and management services for tax and legal residencies',
            'pt' => 'Consultoria e gestão de residências fiscais e legais',
        );

        $seccion5_item8_txt2 = array(
            'es' => 'Estructuración y administración de sociedades de Zona Franca asistiendo en el cumplimiento de la normativa contable, societaria, regulaciones de la Dirección Nacional de Zonas Francas y de liquidación de haberes',
            'en' => 'Structuring and administration of Free Zone companies, assisting in compliance with accounting standards, corporate regulations, Free Zone National Directorate regulations, and settlement of payments',
            'pt' => 'Estruturação e administração de sociedades de Zona Franca, auxiliando no cumprimento das normas contábeis, regulamentos societários, regulamentações da Direção Nacional de Zonas Francas e liquidação de pagamentos',
        );

        $seccion5_item8_txt3 = array(
            'es' => 'Estructuración y administración de sociedades domésticas en observancia del cumplimiento de la normativa contable, tributaria, societaria y de liquidación de haberes',
            'en' => 'Structuring and administration of domestic companies in compliance with accounting, tax, corporate regulations, and settlement of payments',
            'pt' => 'Estruturação e administração de sociedades domésticas em conformidade com normas contábeis, fiscais, societárias e de liquidação de pagamentos',
        );

        $seccion5_item8_txt4 = array(
            'es' => 'Asesoramiento para adquisición y administración de propiedades real estate en Uruguay',
            'en' => 'Advisory services for the acquisition and management of real estate properties in Uruguay',
            'pt' => 'Assessoria para aquisição e administração de propriedades imobiliárias no Uruguay',
        );

        $seccion5_item8_txt5 = array(
            'es' => 'Asesoramiento para la gestión de negocios onshore',
            'en' => 'Advisory services for onshore business management',
            'pt' => 'Assessoria para gestão de negócios onshore',
        );

        $seccion6 = array(
            'es' => 'EN EL MUNDO',
            'en' => 'WORLDWIDE',
            'pt' => 'NO MUNDO',
        );

        $seccion6_tit = array(
            'es' => 'Presencia global, para responder a las exigencias de un mundo interconectado',
            'en' => 'Global presence, to answer to the demands of an interconnected world',
            'pt' => 'Presença global, para atender às demandas de um mundo interconectado',
        );

        $seccion7 = array(
            'es' => 'CONTACTO',
            'en' => 'CONTACT',
            'pt' => 'CONTATO',
        );

        $seccion7_tit = array(
            'es' => 'Contactanos',
            'en' => 'Contact us',
            'pt' => 'Entre em contato',
        );

        $seccion7_tex1 = array(
            'es' => 'Paraguay 2141, Torre 3, Piso 1, Oficina 001,',
            'en' => 'Paraguay 2141, Torre 3, Piso 1, Oficina 001,',
            'pt' => 'Paraguay 2141, Torre 3, Piso 1, Oficina 001,',
        );

        $seccion7_tex2 = array(
            'es' => '(zona franca) Aguada Park (CP 11.800)',
            'en' => '(zona franca) Aguada Park (CP 11.800)',
            'pt' => '(zona franca) Aguada Park (CP 11.800)',
        );

        $seccion7_tex3 = array(
            'es' => '18 de Julio 841, Oficina 401, (CP 11.100)',
            'en' => '18 de Julio 841, Oficina 401, (CP 11.100)',
            'pt' => '18 de Julio 841, Oficina 401, (CP 11.100)',
        );

        $seccion7_tex4 = array(
            'es' => 'Montevideo Uruguay',
            'en' => 'Montevideo Uruguay',
            'pt' => 'Montevideo Uruguay',
        );

        $seccion7_tex5 = array(
            'es' => '+598 2927 2318',
            'en' => '+598 2927 2318',
            'pt' => '+598 2927 2318',
        );

        $seccion7_tex6 = array(
            'es' => 'info@greenocktrustcompany.com',
            'en' => 'info@greenocktrustcompany.com',
            'pt' => 'info@greenocktrustcompany.com',
        );

        $seccion8_tex1 = array(
            'es' => 'Reciba nuestras novedades directamente en su correo. Suscríbase ahora',
            'en' => 'Receive our news directly in your inbox. Subscribe now',
            'pt' => 'Receba nossas novidades diretamente em sua caixa de entrada. Inscreva-se agora',
        );

        $seccion8_tex2 = array(
            'es' => 'Ingrese su correo electrónico',
            'en' => 'Enter your email',
            'pt' => 'Digite seu e-mail',
        );

        $seccion8_tex3 = array(
            'es' => 'Enviar',
            'en' => 'Send',
            'pt' => 'Enviar',
        );

        $seccion9_tex1 = array(
            'es' => 'Hola, quiero más información',
            'en' => 'Hello, I would like more information',
            'pt' => 'Olá, quero mais informações',
        );

        return view('home', compact('lang', 'title', 'description', 'template', 'title0', 'title1', 'title2', 'title3', 'title4', 'title5', 'animleft', 'animright', 'slider', 'slider_boton', 'slide1_tit', 'slide1_tex', 'slide2_tit', 'slide2_tex', 'slide3_tit', 'slide3_tex', 'slide4_tit', 'slide4_tex', 'seccion1', 'seccion1_tit', 'seccion1_tex1', 'seccion1_tex2', 'seccion1_tex3', 'seccion2', 'seccion2_tit', 'seccion2_tex1', 'seccion2_tex2', 'seccion2_tex3', 'seccion3', 'seccion3_tit', 'seccion3_tex1', 'seccion3_tex2', 'seccion3_tex3', 'seccion4', 'seccion4_tit', 'seccion4_tex1', 'seccion4_tex2', 'seccion4_tex3', 'seccion5', 'seccion5_tit', 'seccion5_item1', 'seccion5_item1_txt1', 'seccion5_item2', 'seccion5_item2_txt1', 'seccion5_item3', 'seccion5_item3_txt1', 'seccion5_item3_txt2', 'seccion5_item3_txt3', 'seccion5_item4', 'seccion5_item4_txt1', 'seccion5_item5', 'seccion5_item5_txt1', 'seccion5_item5_txt2', 'seccion5_item6', 'seccion5_item6_txt1', 'seccion5_item6_txt2', 'seccion5_item6_txt3', 'seccion5_item7', 'seccion5_item7_txt1', 'seccion5_item7_txt2', 'seccion5_item7_txt3', 'seccion5_item8', 'seccion5_item8_txt1', 'seccion5_item8_txt2', 'seccion5_item8_txt3', 'seccion5_item8_txt4', 'seccion5_item8_txt5', 'seccion6', 'seccion6_tit', 'seccion7', 'seccion7_tit', 'seccion7_tex1', 'seccion7_tex2', 'seccion7_tex3', 'seccion7_tex4', 'seccion7_tex5', 'seccion7_tex6', 'seccion8_tex1', 'seccion8_tex2', 'seccion8_tex3', 'seccion9_tex1'));
    }

    public function news() {
        $lang = $_GET['lang'] ?? 'es';
        
        $title = [
            'es' => 'Novedades',
            'en' => 'News',
            'pt' => 'Notícias'
        ];

        $title = $title[$lang];

        $description = array(
            'es' => 'Bienvenido a la página de inicio',
            'en' => 'Welcome to the home page',
            'pt' => 'Bem-vindo à página inicial',
        );

        $description = $description[$lang];

        $template="default";

        $title0 = array(
            'es' => 'Inicio',
            'en' => 'Home',
            'pt' => 'Início',
        );

        $title1 = array(
            'es' => 'Nosotros',
            'en' => 'About us',
            'pt' => 'Sobre nós',
        );

        $title2 = array(
            'es' => 'Clientes',
            'en' => 'Clients',
            'pt' => 'Clientes',
        );

        $title3 = array(
            'es' => 'Servicios',
            'en' => 'Services',
            'pt' => 'Serviços',
        );

        $title4 = array(
            'es' => 'Contacto',
            'en' => 'Contact',
            'pt' => 'Contato',
        );

        $title5 = array(
            'es' => 'Novedades',
            'en' => 'News',
            'pt' => 'Notícias',
        );

        $months = array(
            'es' => array(
                '01' => 'Enero',
                '02' => 'Febrero',
                '03' => 'Marzo',
                '04' => 'Abril',
                '05' => 'Mayo',
                '06' => 'Junio',
                '07' => 'Julio',
                '08' => 'Agosto',
                '09' => 'Septiembre',
                '10' => 'Octubre',
                '11' => 'Noviembre',
                '12' => 'Diciembre'
            ),
            'en' => array(
                '01' => 'January',
                '02' => 'February',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'August',
                '09' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December'
            ),
            'pt' => array(
                '01' => 'Janeiro',
                '02' => 'Fevereiro',
                '03' => 'Março',
                '04' => 'Abril',
                '05' => 'Maio',
                '06' => 'Junho',
                '07' => 'Julho',
                '08' => 'Agosto',
                '09' => 'Setembro',
                '10' => 'Outubro',
                '11' => 'Novembro',
                '12' => 'Dezembro'
            )
        );

        $sinNovedades = [
            'es' => 'No hay novedades',
            'en' => 'No news'
        ];
    
        $novedades = [
            'es' => 'Novedades',
            'en' => 'News'
        ];
    
        $leerMas = [
            'es' => 'Leer más',
            'en' => 'Read more'
        ];
    
        $page = 1;
        
        // Los 3 más nuevos
        $carrouselPosts = Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            
        // El resto (sin incluir los 3 más nuevos)
        $remainingCount = Post::count() - 3;
        $posts = Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->skip(3)
            ->take($remainingCount > 0 ? $remainingCount : 0)
            ->get();

        foreach ($posts as $post) {
            $post->setAttribute('title', strip_tags($post->title));

            // formatted_created_at
            $date = date('d-m-Y', strtotime($post->created_at));
            $month = substr($date, 3, 2);
            $year = substr($date, 6, 4);
            $month_name = $months[$lang][$month] ?? $month; // Evita errores si $lang no está definido
            $post->setAttribute('formatted_created_at', $month_name . ' de ' . $year); // No modificar 'created_at));'
        }
        foreach ($carrouselPosts as $post) {
            $post->setAttribute('title', strip_tags($post->title));
            $post->setAttribute('resume', ucfirst(mb_strimwidth(strip_tags($post->resume), 0, 150, '...')));

            // formatted_created_at
            $date = date('d-m-Y', strtotime($post->created_at));
            $month = substr($date, 3, 2);
            $year = substr($date, 6, 4);
            $month_name = $months[$lang][$month] ?? $month; // Evita errores si $lang no está definido
            $post->setAttribute('formatted_created_at', $month_name . ' de ' . $year); // No modificar 'created_at));'
        }
        
        $hasMorePosts = Post::count() > 5;

        $page = 1;

        return view('news', compact(
            'lang',
            'title',
            'description',
            'template',
            'title0',
            'title1',
            'title2',
            'title3',
            'title4',
            'title5',
            'posts',
            'carrouselPosts',
            'sinNovedades',
            'novedades',
            'leerMas',
            'hasMorePosts',
            'page',
        ));
    }

    public function showPost($id) {
        $post = Post::where('id', $id)
            ->with('sections')
            ->first();

        if (!$post) {
            return redirect()->route('error', ['lang' => $this->lang]);
        }
        
        $lang = $this->lang ?? 'es';

        $title = [
            'es' => 'Posteo',
            'en' => 'Post',
            'pt' => 'Postagem'
        ];

        $title = $title[$lang];

        $description = [
            'es' => 'Detalle del posteo.',
            'en' => 'Post details.',
            'pt' => 'Detalhes do post.'
        ];

        $description = $description[$lang];

        $template="default";

        $title0 = array(
            'es' => 'Inicio',
            'en' => 'Home',
            'pt' => 'Início',
        );

        $title1 = array(
            'es' => 'Nosotros',
            'en' => 'About us',
            'pt' => 'Sobre nós',
        );

        $title2 = array(
            'es' => 'Clientes',
            'en' => 'Clients',
            'pt' => 'Clientes',
        );

        $title3 = array(
            'es' => 'Servicios',
            'en' => 'Services',
            'pt' => 'Serviços',
        );

        $title4 = array(
            'es' => 'Contacto',
            'en' => 'Contact',
            'pt' => 'Contato',
        );

        $title5 = array(
            'es' => 'Novedades',
            'en' => 'News',
            'pt' => 'Notícias',
        );

        $post->setAttribute('title', str_replace('<p>', '', $post->title));
        $post->setAttribute('title', str_replace('</p>', '', $post->title));
        $post->setAttribute('resume', str_replace('<p>', '', $post->resume));
        $post->setAttribute('resume', str_replace('</p>', '', $post->resume));

        foreach ($post->sections as $section) {
            $section->setAttribute('title', str_replace('<p>', '', $section->title));
            $section->setAttribute('title', str_replace('</p>', '', $section->title));
            $section->setAttribute('content', str_replace('<p>', '', $section->content));
            $section->setAttribute('content', str_replace('</p>', '', $section->content));
            $section->setAttribute('content', str_replace('<ul>', '<ul class="text-white text-justify ml-2" style="line-height: 2;">', $section->content));
        }

        $sections = [];

        // Agregar acá
        $ordered = $post->sections->sortBy('order')->values()->all();

        $n = count($ordered);
        $half = intdiv($n, 2);

        $left = array_slice($ordered, 0, $half);
        $right = array_slice($ordered, $half);

        for ($i = 0; $i < $half; $i++) {
            $sections[] = $left[$i];
            if (isset($right[$i])) {
                $sections[] = $right[$i];
            }
        }

        if ($n % 2 !== 0) {
            $sections[] = $right[$half];
        }
        
        $post->setRelation('sections', $sections);

        // formated date
        $date = date('d-m-Y', strtotime($post->created_at));
        $month = substr($date, 3, 2);
        $year = substr($date, 6, 4);

        $months = array(
            'es' => array(
                '01' => 'Enero',
                '02' => 'Febrero',
                '03' => 'Marzo',
                '04' => 'Abril',
                '05' => 'Mayo',
                '06' => 'Junio',
                '07' => 'Julio',
                '08' => 'Agosto',
                '09' => 'Septiembre',
                '10' => 'Octubre',
                '11' => 'Noviembre',
                '12' => 'Diciembre'
            ),
            'en' => array(
                '01' => 'January',
                '02' => 'February',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'August',
                '09' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December'
            ),
            'pt' => array(
                '01' => 'Janeiro',
                '02' => 'Fevereiro',
                '03' => 'Março',
                '04' => 'Abril',
                '05' => 'Maio',
                '06' => 'Junho',
                '07' => 'Julho',
                '08' => 'Agosto',
                '09' => 'Setembro',
                '10' => 'Outubro',
                '11' => 'Novembro',
                '12' => 'Dezembro'
            )
        );

        $month_name = $months[$lang][$month] ?? $month; // Evita errores si $lang no está definido
        $post->setAttribute('formatted_created_at', $month_name . ' de ' . $year); // No modificar 'created_at'
        
        return view('post', compact('lang', 'title', 'description', 'template', 'title0', 'title1', 'title2', 'title3', 'title4', 'title5', 'post'));
    }

    public function error() {
        $lang = $_GET['lang'] ?? 'es';

        $title = [
            'es' => 'Error',
            'en' => 'Error',
            'pt' => 'Erro'
        ];

        $description = [
            'es' => 'Error en la página.',
            'en' => 'Error on the page.',
            'pt' => 'Erro na página.'
        ];

        $template="default";

        $title0 = array(
            'es' => 'Inicio',
            'en' => 'Home',
            'pt' => 'Início',
        );
        $title1 = array(
            'es' => 'Nosotros',
            'en' => 'About us',
            'pt' => 'Sobre nós',
        );
        $title2 = array(
            'es' => 'Clientes',
            'en' => 'Clients',
            'pt' => 'Clientes',
        );
        $title3 = array(
            'es' => 'Servicios',
            'en' => 'Services',
            'pt' => 'Serviços',
        );
        $title4 = array(
            'es' => 'Contacto',
            'en' => 'Contact',
            'pt' => 'Contato',
        );
        $title5 = array(
            'es' => 'Novedades',
            'en' => 'News',
            'pt' => 'Notícias',
        );

        // Quiero crear un objeto de error con code, message and description
        $error = new \stdClass();
        
        $error->code = 404;
        
        $error->message = [
            'es' => 'Página no encontrada',
            'en' => 'Page not found',
            'pt' => 'Página não encontrada'
        ];
        
        $error->description = [
            'es' => 'La página que buscas no existe. Por favor verifica la URL o vuelve a la página de inicio.',
            'en' => 'The page you are looking for does not exist. Please check the URL or return to the home page.',
            'pt' => 'A página que você está procurando não existe. Verifique a URL ou volte para a página inicial.'
        ];

        return view('error', [
            'lang' => $lang,
            'title' => $title[$lang],
            'description' => $description[$lang],
            'template' => $template,
            'title0' => $title0[$lang],
            'title1' => $title1[$lang],
            'title2' => $title2[$lang],
            'title3' => $title3[$lang],
            'title4' => $title4[$lang],
            'title5' => $title5[$lang],
            'error' => $error
        ]);
    }
}
