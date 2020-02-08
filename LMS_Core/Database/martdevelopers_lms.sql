-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2020 at 12:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `martdevelopers_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `lms-course_work`
--

CREATE TABLE `lms-course_work` (
  `cw_id` int(20) NOT NULL,
  `cw_code` varchar(200) NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `cw_c_name` varchar(200) NOT NULL,
  `cw_c_code` varchar(200) NOT NULL,
  `cw_c_category` varchar(200) NOT NULL,
  `cw_details` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_admin`
--

CREATE TABLE `lms_admin` (
  `a_id` int(20) NOT NULL,
  `a_name` varchar(200) NOT NULL,
  `a_uname` varchar(200) NOT NULL,
  `a_email` varchar(200) NOT NULL,
  `a_pwd` varchar(200) NOT NULL,
  `a_dpic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_admin`
--

INSERT INTO `lms_admin` (`a_id`, `a_name`, `a_uname`, `a_email`, `a_pwd`, `a_dpic`) VALUES
(1, 'Ann Mwaka', 'Ann', 'sysadmin@lms.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'IMG_20170820_101024.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lms_answers`
--

CREATE TABLE `lms_answers` (
  `an_id` int(20) NOT NULL,
  `q_code` varchar(200) NOT NULL,
  `an_code` varchar(200) NOT NULL,
  `cc_id` varchar(200) NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `c_code` varchar(200) NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `q_id` varchar(200) NOT NULL,
  `q_details` longtext NOT NULL,
  `ans_details` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_answers`
--

INSERT INTO `lms_answers` (`an_id`, `q_code`, `an_code`, `cc_id`, `c_id`, `c_code`, `c_name`, `i_id`, `q_id`, `q_details`, `ans_details`) VALUES
(6, 'QNS-WDOS', 'ANS-XBWF', '5', '13', 'CS908', 'Spring Boot Framework Basics', '7', '10', '<ul><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question1\"><strong>Q 1. What does Spring Boot mean?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question2\"><strong>Q 2. What are the various Advantages Of Using Spring Boot?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question3\"><strong>Q 3. What are the various features of Spring Boot?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question4\"><strong>Q 4. What is the reason to have a spring-boot-maven module?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question5\"><strong>Q 5. How to make Spring Boot venture utilizing Spring Initializer?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question6\"><strong>Q 6. What do Dev Tools in Spring boot mean?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question7\"><strong>Q 7. What does Spring Boot Starter Pom mean? Why Is It Useful?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question8\"><strong>Q 8. What does Actuator in Spring Boot mean?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question9\"><strong>Q 9. What Is the Configuration File Name Used By Spring Boot?</strong></a></li><li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question10\"><strong>Q 10. Why in spring boot &ldquo;Opinionated &rdquo; is used?</strong></a></li></ul>', '<p><strong>Q1.</strong> What does Spring Boot mean?</p><p><strong>Spring Boot</strong> is a system from &quot;The Spring Team&quot; to facilitate the bootstrapping and development of new Spring Applications. It gives defaults to code, and annotation configurations to snappy begin new spring projects at no time. It takes after the &quot;Opinionated Defaults Configuration&quot; Approach to escape from a lot of standard code and configuration to enhance Development, Unit Test, and Integration Test Process.</p><p><strong>Q2.</strong> What are the various Advantages Of Using Spring Boot?</p><p>Here are some of the various advantages of using <strong>Spring Boot</strong>:</p><ul><li>It is quite easy to create Spring Based applications with Java or Groovy.</li><li>It lessens lots of improvement time and expands profitability.</li><li>It abstains from writing lots of standard Codes, Annotations, and XML Configuration.</li><li>It is quite easy to coordinate Spring Boot Application with its Spring Ecosystem like Spring JDBC, Spring ORM, Spring Data, Spring Security and so forth.</li><li>It takes after the &quot;Opinionated Defaults Configuration&quot; Approach to diminish Developer effort</li><li>It gives Embedded HTTP servers like Tomcat, Jetty and more to create and test our web applications effectively.</li><li>It gives CLI (Command Line Interface) tool to create and test Spring Boot (Java or Groovy) Applications from commanding prompt very easily and rapidly.</li><li>It gives lots of modules to create and test Spring Boot Applications effectively utilizing Build Tools like Maven and Gradle</li><li>It provides loads of plug-ins to work with implanted and in-memory Databases effortlessly.</li></ul><p><strong>Q3.</strong> What are the various features of Spring Boot?</p><p><strong>Various Spring Boot Features are as follows</strong>:</p><ul><li>Web Development</li><li>Spring Application</li><li>Application occasions and listeners</li><li>Admin highlights</li><li>Externalized Configuration</li><li>Properties Files</li><li>YAML Support</li><li>Type-safe Configuration</li><li>Logging</li><li>Security</li></ul><p><strong>Q4.</strong> What is the reason to have a spring-boot-maven module?</p><p>The reason behind to have Spring-boot-maven module is it gives a couple of charges which empower you to package the code as a container or run the application</p><ul><li>spring-boot: run operates your Spring Boot application.</li><li>spring-boot: repackage it repackages your jug/war to be executable.</li><li>spring-boot: start and spring-boot: stop to deal with the lifecycle of your Spring Boot application (i.e., for joining tests).</li><li>spring-boot: build-data creates build data that can be utilized by the Actuator.</li></ul><p><strong>Q5.</strong> How to make Spring Boot venture utilizing Spring Initializer?</p><p>The Spring Initializer is a web application that can produce a Spring Boot project structure for you. It doesn&rsquo;t create any application code. However, it will give you an essential project structure and either a Maven or a Gradle build specification to fabricate your code with. You should simply compose the application code.</p><p>Spring Initializer can be utilized a few different ways, including:</p><ul><li>An online interface.</li><li>Via Spring Tool Suite.</li><li>Using the Spring Boot CLI.</li></ul><p><strong>Q6.</strong> What do Dev Tools in Spring boot mean?</p><p>Spring boot accompanies Dev Tools, which is acquainted with increase the profitability of designer. You don&rsquo;t have to redeploy your application each time you influence the changes. The developer can reload the progressions without restart of the server. It maintains a strategic distance from the agony of redeploying application each time when you roll out any improvement. This module will can&rsquo;t be utilized in a production environment.</p><p><strong>Q7.</strong> What does Spring Boot Starter Pom mean? Why Is It Useful?</p><p>Starters are an arrangement of advantageous reliance descriptors that you can incorporate into your application. The starters contain a considerable amount of the dependencies that you have to get a task up and running rapidly and with a steady, supported a set of managed transitive conditions.</p><p>The starter POMs are helpful reliance descriptors that can be added to your application&rsquo;s Maven. In another word, if you are building up a project that utilizes Spring Batch for batch preparing, you need to incorporate spring-boot-starter-bunch that will import all the required conditions for the Spring Batch application. This decreases the burden of looking at and designing all of the conditions required for a structure.</p><p><strong>Q8.</strong> What does Actuator in Spring Boot mean?</p><p>Spring Boot Actuator is a sub-task of Spring Boot. It adds a few creation review administrations to your application with little exertion on your part. There are also has numerous features added to your application out-of-the-case for dealing with the administration in a production (or other) condition. They&rsquo;re basically used to uncover diverse kinds of data about the running application &ndash; health, measurements, information, dump, env and so on.</p><p><strong>Q9.</strong> What Is the Configuration File Name Used By Spring Boot?</p><p>The configuration record utilized as a part of spring boot ventures is an application. Properties. This record is imperative where we would overwrite all the default designs. Regularly we need to hold this document under the assets envelope of the project.</p><p><strong>Q10.</strong> Why in spring boot &ldquo;Opinionated &rdquo; is used?</p><p>It takes after &quot;<strong>Opinionated Defaults Configuration&quot;</strong>&nbsp;Approach to lessen Developer exertion. Because of the Opinionated perspective of spring boot, what is required to begin yet additionally we can get out if not appropriate for the application. Spring Boot utilizes sensible defaults, &ldquo;opinions,&rdquo; for the most part in light of the classpath substance.</p><p><strong>Q11.</strong> What are esteem properties of Spring Boot?</p><p>Spring Boot gives different properties, which can be indicated in our project&rsquo;s application. Properties record. These properties have default values, and you can set that inside the properties record. Properties are utilized to set qualities like a server-port number, database association configuration and much more.</p><p><strong>Q12.</strong> What Is the Configuration File Name, which is used By Spring Boot?</p><p>The configuration file name, which is utilized as a part of spring boot projects is application.properties. This document is very important where we would overwrite all the default setups. Ordinarily, we need to hold this document under the assets folder of the project.</p><p><strong>Q13.</strong> Would we be able to Use Spring Boot with Applications Which Are Not Using Spring?</p><p>No, it isn&rsquo;t conceivable starting at now. Spring boot is restricted to Spring applications only.</p><p><strong>Q14.</strong> What Is Name Of The Configuration File, Which You Use In Spring Boot?</p><p>Configuration file name which is utilized as a part of Spring boot ventures is known as <strong>application. Properties</strong>. It is vital to document as it is utilized to abrogate all default configurations.</p><p><strong>Q15.</strong> How Might You Implement Spring Security In Spring Boot Application?</p><p>Usage of spring security in Spring boot application requires quite a little configuration. You have to include spring-boot-starter-security starter in pom.xml. You need to make spring config class, which will expand <strong>WebSecurity Configure</strong> <strong>Adapter</strong> and override expected strategy to accomplish security in Spring boot application.</p><p><strong>Q16.</strong> Would you be able to Control Logging with Spring Boot? How?</p><p>Yes, we can control logging with spring boot.</p><p><strong>Q17.</strong> Differentiate Between An Embedded Container And A War?</p><p>There is no force to go containerless</p><ul><li>The embedded container is only one component of Spring Boot</li><li>Traditional WAR additionally benefits a considerable measure from Spring Boot</li><li>Automatic Spring MVC setup, including Dispatcher Servlet</li><li>Sensible defaults in light of the class-path content</li><li>The embedded container can be utilized during improvement.</li></ul><p><strong>Q18.</strong> What does Spring Security mean?</p><p><strong>Spring Security</strong> is a groundbreaking and very adjustable authentication and access-control structure. It is the true standard for securing Spring-based applications. Spring Security is a system that spotlights on giving both authentication and approval to Java applications. Like all spring ventures, the genuine power of Spring Security is found in how effectively it can be reached out to meet custom prerequisites.</p><p><strong>Q19.</strong> What does Aspect-Oriented Programming (AOP) mean?</p><p>Aspect Oriented Programming (AOP) supplements Object-Oriented Programming (OOP) by giving another mindset about program structure. The key unit of measured quality in OOP is the class, while in AOP the unit of particularity is the viewpoint. Angles empower the modularization of concerns, for example, transaction management that cut over numerous sorts and questions.</p><p><strong>Q20.</strong> Describe some of the spring sub-projects briefly?</p><p>Various spring sub-projects are as follows:</p><ul><li><strong>JDBC:</strong> this module empowers a JDBC-deliberation layer that evaluates the need to do JDBC coding for particular vendor databases<br /><strong><a target=\"_blank\" href=\"https://www.onlineinterviewquestions.com/jdbc-interview-questions/\">Read Best JDBC Interview Questions</a></strong></li><li><strong>Core:</strong> a key module that gives basic parts of the system, as IoC or DI</li><li><strong>Web:</strong> a web-situated joining module, giving multipart document upload, listeners members, and web-arranged application context functionalities</li><li><strong>ORM integration:</strong> gives mix layers to well-known protest object-relational mapping APIs, for example, JPA, JDO, and Hibernate</li><li><strong>AOP module:</strong> perspective oriented programming execution is permitting the meaning of clean strategy interceptors and pointcuts.</li><li><strong>MVC system: </strong> a web module executing the Model View Controller configuration design</li></ul><p><strong>Q21.</strong> Explain the difference between JPA and Hibernate?</p><p>JPA is a specification/Interface whereas Hibernate is one of the JPA implementations.</p><p><strong>Q22.</strong> How to connect to an external database like MSSQL or oracle with Spring boot?</p><p>It is done in the following steps.</p><p><strong>Step 1</strong> -</p><p>The first step to connect the database like Oracle or MySql is adding the dependency for your database connector to pom.xml.</p><p><strong>Step 2</strong> -</p><p>The next step is the elimination of H2 Dependency from pom.xml</p><p><strong>Step 3</strong> -</p><p>Step 3 includes the schema and table to establish your database.</p><p><strong>Step 4</strong> -</p><p>The next step is configuring of the database by using Configure application.properties to connect to your database.</p><p><strong>Step 5</strong>-</p><p>And the last step is to restart your device and your connection is ready to use.</p><p><strong>Q23.</strong> How to add custom JS code in Spring Boot?</p><p><strong>/src/main/resources/static</strong> is the suggested folder for static content in Spring boot.</p><p>You can create a JS file for sending an alert by creating a custom file named custom.js in /src/main/resources/static/js/ directory with below code</p><p>alert(&quot;I&#39;m active&quot;);</p><p><strong>Q24.</strong> List minimum requirements for Spring boot System?</p><p><strong>Spring Boot 1.5.10</strong>. RELEASE requires</p><ul><li>Java 7 +</li><li>Spring 4.3.13 +</li></ul><p><strong>For build support</strong></p><ul><li>Maven 3.2+</li><li>Gradle 2.9+</li></ul><p><strong>Container Support</strong></p><ul><li>Tomcat 7+</li><li>Jetty 8+ (Jetty 9.3 requires JDK 8 +)</li></ul><p><strong>Q25.</strong> What is Auto Configuration in Spring boot?</p><p><strong>Autoconfiguration</strong> is way in Spring Boot to configure a spring application automatically on the basis of dependencies that are present on the classpath. It makes development easier and faster.</p><p>You can create a custom configuration for a MySQL data source in spring boot as</p><p>@Configuration public class MySQLAutoconfiguration { //... }</p><p><strong>Q26.</strong> How can you enable auto reload of application with Spring Boot?</p><p>You can enable auto-reload/LiveReload of spring boot application by adding the <strong>spring-boot-devtools</strong> dependency in the<strong> pom.xml</strong> file.</p><p>&lt;dependency&gt; &lt;groupId&gt;org.springframework.boot&lt;/groupId&gt; &lt;artifactId&gt;spring-boot-devtools&lt;/artifactId&gt; &lt;optional&gt;true &lt;/dependency&gt;</p><p><strong>Note:</strong> please restart your application for immediate effects.</p><p><strong>Q27.</strong> How to enable HTTP/2 support in Spring Boot?</p><p>You can enable HTTP/2 support in Spring Boot as follows: server.http2.enabled=true</p><p>Example:-</p><p>@Bean public ConfigurableServletWebServerFactory tomcatCustomizer() { TomcatServletWebServerFactory factory = new TomcatServletWebServerFactory(); factory.addConnectorCustomizers(connector -&gt; connector.addUpgradeProtocol(new Http2Protocol())); return factory; }</p><p><strong>Q28.</strong> How do you Enable HTTP response compression in spring boot?</p><p>To enable <strong>HTTP response compression in spring boot</strong> using GZIP you have to add below settings in your application.properties file.</p><p># Enabling HTTP response compression in spring boot server.compression.enabled=true server.compression.min-response-size=2048 server.compression.mime-types=application/json,application/xml,text/html,text/xml,text/plain</p><p><strong>Q29.</strong> What is the difference between RequestMapping and GetMapping in Spring Boot?</p><p>Both @GetMapping and @RequestMapping are annotations for mapping HTTP GET requests onto specific handler methods in Spring boot. @GetMapping is a composed annotation that acts as a shortcut for @RequestMapping. @GetMapping is the newer annotation.</p><p><strong>Q30.</strong> What are Actuator in Spring Boot?</p><p><strong>Actuator</strong> is a tool in Spring Boot for monitoring and managing our application. Actuator Monitors our app, gathers metrics, understands traffic or the state of our database. It uses HTTP endpoints or JMX beans to enable us to interact with it. An actuator is available to use from the first release of Spring Boot.</p><p>Here is a youtube video by Java Brains to understand Spring Boot Actuator</p><p><strong>Q31.</strong> What is the use of @SpringBootApplication annotation?</p><p><strong>@SpringBootApplication</strong> annotation was introduced in Spring Boot version 1.2.0. It is a convenience annotation which is used in spring boot application to enable additions of beans using the classpath definitions.</p><p><strong>Q32.</strong> How do you configure error logging/debugging in Spring boot application?</p><p>You can configure error logging/debugging in Spring boot application by applying the following settings in application.properties or application.yml file.</p><p>logging.level.org.springframework.web: DEBUG logging.level.org.hibernate: ERROR</p><p><strong>Q33.</strong> What is the Spring Boot Initilizr?</p><p><strong>Spring Boot Initilizr</strong> is a web interface which to rapidly create spring boot projects. Using this tool you can create Maven and Gradle projects. You can find Spring Boot Initilizr tool on <a target=\"_blank\" href=\"https://start.spring.io/\">https://start.spring.io/</a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `lms_billings`
--

CREATE TABLE `lms_billings` (
  `b_id` int(20) NOT NULL,
  `b_amt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_certs`
--

CREATE TABLE `lms_certs` (
  `cert_id` int(20) NOT NULL,
  `en_id` varchar(200) NOT NULL,
  `s_id` varchar(200) NOT NULL,
  `s_regno` varchar(200) NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `s_unit_code` varchar(200) NOT NULL,
  `s_unit_name` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `i_name` varchar(200) NOT NULL,
  `en_date` varchar(200) NOT NULL,
  `date_generated` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4) ON UPDATE CURRENT_TIMESTAMP(4)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_certs`
--

INSERT INTO `lms_certs` (`cert_id`, `en_id`, `s_id`, `s_regno`, `s_name`, `s_unit_code`, `s_unit_name`, `i_id`, `i_name`, `en_date`, `date_generated`) VALUES
(10, '19', '7', 'CSC900167', 'Student One', 'CS908', 'Spring Boot Framework Basics', '7', 'Instructor One', '08 Feb 2020', '2020-02-08 10:56:31.9934');

-- --------------------------------------------------------

--
-- Table structure for table `lms_course`
--

CREATE TABLE `lms_course` (
  `c_id` int(20) NOT NULL,
  `cc_id` varchar(200) NOT NULL,
  `a_id` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `c_code` varchar(200) NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `c_category` varchar(200) NOT NULL,
  `c_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_course`
--

INSERT INTO `lms_course` (`c_id`, `cc_id`, `a_id`, `i_id`, `c_code`, `c_name`, `c_category`, `c_desc`) VALUES
(12, '4', '1', '', 'IT2089', 'Object Oriented Programming ', 'Information Technology', '<p><strong>Object-oriented programming</strong> (<strong>OOP</strong>) is a <a href=\"https://en.wikipedia.org/wiki/Programming_paradigm\">programming paradigm</a> based on the concept of &quot;<a href=\"https://en.wikipedia.org/wiki/Object_(computer_science)\">objects</a>&quot;, which can contain <a href=\"https://en.wikipedia.org/wiki/Data\">data</a>, in the form of <a href=\"https://en.wikipedia.org/wiki/Field_(computer_science)\">fields</a> (often known as <em>attributes</em> or <em>properties</em>), and code, in the form of procedures (often known as <em><a href=\"https://en.wikipedia.org/wiki/Method_(computer_science)\">methods</a></em>). A feature of objects is an object&#39;s procedures that can access and often modify the data fields of the object with which they are associated (objects have a notion of &quot;<a href=\"https://en.wikipedia.org/wiki/This_(computer_programming)\">this</a>&quot; or &quot;self&quot;). In OOP, computer programs are designed by making them out of objects that interact with one another.<a href=\"https://en.wikipedia.org/wiki/Object-oriented_programming#cite_note-1\">[1]</a><a href=\"https://en.wikipedia.org/wiki/Object-oriented_programming#cite_note-2\">[2]</a> OOP languages are diverse, but the most popular ones are <a href=\"https://en.wikipedia.org/wiki/Class-based_programming\">class-based</a>, meaning that objects are <a href=\"https://en.wikipedia.org/wiki/Instance_(computer_science)\">instances</a> of <a href=\"https://en.wikipedia.org/wiki/Class_(computer_science)\">classes</a>, which also determine their <a href=\"https://en.wikipedia.org/wiki/Data_type\">types</a>.</p><p>Many of the most widely used programming languages (such as C++, Java, Python, etc.) are <a href=\"https://en.wikipedia.org/wiki/Multi-paradigm_programming_language\">multi-paradigm</a> and they support object-oriented programming to a greater or lesser degree, typically in combination with <a href=\"https://en.wikipedia.org/wiki/Imperative_programming\">imperative</a>, <a href=\"https://en.wikipedia.org/wiki/Procedural_programming\">procedural programming</a>. Significant object-oriented languages include <a href=\"https://en.wikipedia.org/wiki/Java_(programming_language)\">Java</a>, <a href=\"https://en.wikipedia.org/wiki/C%2B%2B\">C++</a>, <a href=\"https://en.wikipedia.org/wiki/C_Sharp_(programming_language)\">C#</a>, <a href=\"https://en.wikipedia.org/wiki/Python_(programming_language)\">Python</a>, <a href=\"https://en.wikipedia.org/wiki/PHP\">PHP</a>, <a href=\"https://en.wikipedia.org/wiki/JavaScript\">JavaScript</a>, <a href=\"https://en.wikipedia.org/wiki/Ruby_(programming_language)\">Ruby</a>, <a href=\"https://en.wikipedia.org/wiki/Perl\">Perl</a>, <a href=\"https://en.wikipedia.org/wiki/Object_Pascal\">Object Pascal</a>, <a href=\"https://en.wikipedia.org/wiki/Objective-C\">Objective-C</a>, <a href=\"https://en.wikipedia.org/wiki/Dart_(programming_language)\">Dart</a>, <a href=\"https://en.wikipedia.org/wiki/Swift_(programming_language)\">Swift</a>, <a href=\"https://en.wikipedia.org/wiki/Scala_(programming_language)\">Scala</a>, <a href=\"https://en.wikipedia.org/wiki/Common_Lisp\">Common Lisp</a>, <a href=\"https://en.wikipedia.org/wiki/MATLAB\">MATLAB</a>, and <a href=\"https://en.wikipedia.org/wiki/Smalltalk\">Smalltalk</a>.</p>'),
(13, '5', '1', '', 'CS908', 'Spring Boot Framework Basics', 'Computer Science', '<p>The <strong>Spring Framework</strong> is an <a href=\"https://en.wikipedia.org/wiki/Application_framework\">application framework</a> and <a href=\"https://en.wikipedia.org/wiki/Inversion_of_control\">inversion of control</a> <a href=\"https://en.wikipedia.org/wiki/Servlet_container\">container</a> for the <a href=\"https://en.wikipedia.org/wiki/Java_platform\">Java platform</a>. The framework&#39;s core features can be used by any Java application, but there are extensions for building web applications on top of the <a href=\"https://en.wikipedia.org/wiki/Java_EE\">Java EE</a> (Enterprise Edition) platform. Although the framework does not impose any specific <a href=\"https://en.wikipedia.org/wiki/Programming_model\">programming model</a>, it has become popular in the Java community as an addition to, or even replacement for the <a href=\"https://en.wikipedia.org/wiki/Enterprise_JavaBeans\">Enterprise JavaBeans</a> (EJB) model. The Spring Framework is <a href=\"https://en.wikipedia.org/wiki/Open-source_software\">open source</a>.</p><p>The Spring Framework includes several modules that provide a range of services:</p><ul><li>Spring Core Container: this is the base module of Spring and provides spring containers (BeanFactory and ApplicationContext).<a href=\"https://en.wikipedia.org/wiki/Spring_Framework#cite_note-12\">[12]</a></li><li><a href=\"https://en.wikipedia.org/wiki/Aspect-oriented_programming\">Aspect-oriented programming</a>: enables implementing <a href=\"https://en.wikipedia.org/wiki/Cross-cutting_concern\">cross-cutting concerns</a>.</li><li><a href=\"https://en.wikipedia.org/wiki/Authentication\">Authentication</a> and <a href=\"https://en.wikipedia.org/wiki/Authorization\">authorization</a>: configurable security processes that support a range of standards, protocols, tools and practices via the <a href=\"https://en.wikipedia.org/wiki/Spring_Security\">Spring Security</a> sub-project (formerly Acegi Security System for Spring).</li><li><a href=\"https://en.wikipedia.org/wiki/Convention_over_configuration\">Convention over configuration</a>: a rapid application development solution for Spring-based enterprise applications is offered in the <a href=\"https://en.wikipedia.org/wiki/Spring_Roo\">Spring Roo</a> module</li><li><a href=\"https://en.wikipedia.org/wiki/Data_access\">Data access</a>: working with <a href=\"https://en.wikipedia.org/wiki/RDBMS\">relational database management systems</a> on the Java platform using <a href=\"https://en.wikipedia.org/wiki/Java_Database_Connectivity\">Java Database Connectivity</a> (JDBC) and <a href=\"https://en.wikipedia.org/wiki/Object-relational_mapping\">object-relational mapping</a> tools and with <a href=\"https://en.wikipedia.org/wiki/NoSQL\">NoSQL</a> databases</li><li><a href=\"https://en.wikipedia.org/wiki/Inversion_of_control\">Inversion of control</a> container: configuration of application components and lifecycle management of Java objects, done mainly via <a href=\"https://en.wikipedia.org/wiki/Dependency_injection\">dependency injection</a></li><li>Messaging: configurative registration of message listener objects for transparent message-consumption from <a href=\"https://en.wikipedia.org/wiki/Message_queue\">message queues</a> via <a href=\"https://en.wikipedia.org/wiki/Java_Message_Service\">Java Message Service</a> (JMS), improvement of message sending over standard JMS APIs</li><li><a href=\"https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller\">Model&ndash;view&ndash;controller</a>: an <a href=\"https://en.wikipedia.org/wiki/HTTP\">HTTP</a>- and <a href=\"https://en.wikipedia.org/wiki/Java_Servlet_API\">servlet</a>-based framework providing hooks for extension and customization for web applications and <a href=\"https://en.wikipedia.org/wiki/REST\">RESTful</a> (representational state transfer) Web services.</li><li>Remote access framework: configurative <a href=\"https://en.wikipedia.org/wiki/Remote_procedure_call\">remote procedure call</a> (RPC)-style <a href=\"https://en.wikipedia.org/wiki/Marshalling_(computer_science)\">marshalling</a> of Java objects over networks supporting <a href=\"https://en.wikipedia.org/wiki/Java_remote_method_invocation\">Java remote method invocation</a> (RMI), <a href=\"https://en.wikipedia.org/wiki/CORBA\">CORBA</a> (Common Object Request Broker Architecture) and <a href=\"https://en.wikipedia.org/wiki/HTTP\">HTTP</a>-based protocols including <a href=\"https://en.wikipedia.org/wiki/Web_services\">Web services</a> (<a href=\"https://en.wikipedia.org/wiki/SOAP_(protocol)\">SOAP (Simple Object Access Protocol)</a>)</li><li><a href=\"https://en.wikipedia.org/wiki/Transaction_processing\">Transaction management</a>: unifies several transaction management APIs and coordinates transactions for Java objects</li><li>Remote management: configurative exposure and management of Java objects for local or remote configuration via <a href=\"https://en.wikipedia.org/wiki/Java_Management_Extensions\">Java Management Extensions</a> (JMX)</li><li><a href=\"https://en.wikipedia.org/wiki/Software_testing\">Testing</a>: support classes for writing unit tests and integration tests</li></ul>');

-- --------------------------------------------------------

--
-- Table structure for table `lms_course_categories`
--

CREATE TABLE `lms_course_categories` (
  `cc_id` int(20) NOT NULL,
  `cc_name` varchar(200) NOT NULL,
  `cc_dept_head` varchar(200) NOT NULL,
  `cc_code` varchar(200) NOT NULL,
  `cc_desc` longtext NOT NULL,
  `cc_dpic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_course_categories`
--

INSERT INTO `lms_course_categories` (`cc_id`, `cc_name`, `cc_dept_head`, `cc_code`, `cc_desc`, `cc_dpic`) VALUES
(4, 'Information Technology', 'Instructor One', 'IT', '<p><strong>Information technology</strong> (<strong>IT</strong>) is the use of <a href=\"https://en.wikipedia.org/wiki/Computer\">computers</a> to store, retrieve, transmit, and manipulate <a href=\"https://en.wikipedia.org/wiki/Data_(computing)\">data</a><a href=\"https://en.wikipedia.org/wiki/Information_technology#cite_note-DOP-1\">[1]</a> or <a href=\"https://en.wikipedia.org/wiki/Information\">information</a>. IT is typically used within the context of business operations as opposed to personal or entertainment technologies.<a href=\"https://en.wikipedia.org/wiki/Information_technology#cite_note-2\">[2]</a> IT is considered to be a subset of <a href=\"https://en.wikipedia.org/wiki/Information_and_communications_technology\">information and communications technology</a> (ICT). An <strong>information technology system</strong> (<strong>IT system</strong>) is generally an <a href=\"https://en.wikipedia.org/wiki/Information_system\">information system</a>, a <a href=\"https://en.wikipedia.org/wiki/Communications_system\">communications system</a> or, more specifically speaking, a <a href=\"https://en.wikipedia.org/wiki/Computer_system\">computer system</a> &ndash; including all <a href=\"https://en.wikipedia.org/wiki/Computer_hardware\">hardware</a>, <a href=\"https://en.wikipedia.org/wiki/Software\">software</a> and <a href=\"https://en.wikipedia.org/wiki/Peripheral\">peripheral</a> equipment &ndash; operated by a limited group of users.</p>', '8b1783c6338c13275f325c13363c756f.png'),
(5, 'Computer Science', 'Instructor One', 'CS', '<p><strong>Computer science</strong> (sometimes called <strong>computation science</strong>) is the study of <a href=\"https://en.wikipedia.org/wiki/Process_(engineering)\">processes</a> that interact with <a href=\"https://en.wikipedia.org/wiki/Data\">data</a> and that can be represented as data in the form of <a href=\"https://en.wikipedia.org/wiki/Computer_program\">programs</a>. It enables the use of <a href=\"https://en.wikipedia.org/wiki/Algorithm\">algorithms</a> to <a href=\"https://en.wikipedia.org/wiki/Data_processing\">manipulate</a>, <a href=\"https://en.wikipedia.org/wiki/Data_storage\">store</a>, and <a href=\"https://en.wikipedia.org/wiki/Communication\">communicate</a> <a href=\"https://en.wikipedia.org/wiki/Digital_data\">digital information</a>. A <a href=\"https://en.wikipedia.org/wiki/Computer_scientist\">computer scientist</a> studies the <a href=\"https://en.wikipedia.org/wiki/Theory_of_computation\">theory of computation</a> and the practice of <a href=\"https://en.wikipedia.org/wiki/Software_design\">designing</a> <a href=\"https://en.wikipedia.org/wiki/Software_system\">software systems</a>.<a href=\"https://en.wikipedia.org/wiki/Computer_science#cite_note-1\">[1]</a></p><p>Its fields can be divided into theoretical and <a href=\"https://en.wikipedia.org/wiki/Practical_disciplines\">practical disciplines</a>. <a href=\"https://en.wikipedia.org/wiki/Computational_complexity_theory\">Computational complexity theory</a> is highly abstract, while <a href=\"https://en.wikipedia.org/wiki/Computer_graphics_(computer_science)\">computer graphics</a> emphasizes real-world applications. <a href=\"https://en.wikipedia.org/wiki/Programming_language_theory\">Programming language theory</a> considers approaches to the description of computational processes, while <a href=\"https://en.wikipedia.org/wiki/Software_engineering\">software engineering</a> involves the use of <a href=\"https://en.wikipedia.org/wiki/Programming_language\">programming languages</a> and <a href=\"https://en.wikipedia.org/wiki/Complex_systems\">complex systems</a>. <a href=\"https://en.wikipedia.org/wiki/Human%E2%80%93computer_interaction\">Human&ndash;computer interaction</a> considers the challenges in making computers useful, usable, and <a href=\"https://en.wikipedia.org/wiki/Computer_accessibility\">accessible</a>.</p>', 'cs.png'),
(6, 'Graphic Design', 'Instructor One', 'GD', '<p><strong>Graphic design</strong> is the process of visual communication and problem-solving through the use of <a href=\"https://en.wikipedia.org/wiki/Typography\">typography</a>, <a href=\"https://en.wikipedia.org/wiki/Photography\">photography</a>, and <a href=\"https://en.wikipedia.org/wiki/Illustration\">illustration</a>. The field is considered a subset of <a href=\"https://en.wikipedia.org/wiki/Visual_communication\">visual communication</a> and <a href=\"https://en.wikipedia.org/wiki/Communication_design\">communication design</a>, but sometimes the term &quot;graphic <a href=\"https://en.wikipedia.org/wiki/Design\">design</a>&quot; is used synonymously. Graphic designers create and combine symbols, images and text to form visual representations of ideas and messages. They use <a href=\"https://en.wikipedia.org/wiki/Typography\">typography</a>, <a href=\"https://en.wikipedia.org/wiki/Visual_arts\">visual arts</a>, and <a href=\"https://en.wikipedia.org/wiki/Page_layout\">page layout</a> techniques to create <a href=\"https://en.wikipedia.org/wiki/Composition_(visual_arts)\">visual compositions</a>. Common uses of graphic design include <a href=\"https://en.wikipedia.org/wiki/Corporate_design\">corporate design</a> (logos and branding), editorial design (magazines, newspapers and books), <a href=\"https://en.wikipedia.org/wiki/Wayfinding\">wayfinding or environmental design</a>, <a href=\"https://en.wikipedia.org/wiki/Advertising\">advertising</a>, <a href=\"https://en.wikipedia.org/wiki/Web_design\">web design</a>, <a href=\"https://en.wikipedia.org/wiki/Communication_design\">communication design</a>, product <a href=\"https://en.wikipedia.org/wiki/Packaging_and_labeling\">packaging</a>, and <a href=\"https://en.wikipedia.org/wiki/Signage\">signage</a>.</p>', 'graphic-design.png');

-- --------------------------------------------------------

--
-- Table structure for table `lms_enrollments`
--

CREATE TABLE `lms_enrollments` (
  `en_id` int(20) NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `s_regno` varchar(200) NOT NULL,
  `s_unit_code` varchar(200) NOT NULL,
  `s_unit_name` varchar(200) NOT NULL,
  `i_name` varchar(200) NOT NULL,
  `cc_id` varchar(200) NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `s_id` varchar(200) NOT NULL,
  `s_course` varchar(200) NOT NULL,
  `en_date` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4) ON UPDATE CURRENT_TIMESTAMP(4)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_enrollments`
--

INSERT INTO `lms_enrollments` (`en_id`, `s_name`, `s_regno`, `s_unit_code`, `s_unit_name`, `i_name`, `cc_id`, `c_id`, `i_id`, `s_id`, `s_course`, `en_date`) VALUES
(19, 'Student One', 'CSC900167', 'CS908', 'Spring Boot Framework Basics', 'Instructor One', '5', '13', '7', '7', 'Computer Science', '2020-02-08 10:44:40.4457');

-- --------------------------------------------------------

--
-- Table structure for table `lms_forum`
--

CREATE TABLE `lms_forum` (
  `f_id` int(20) NOT NULL,
  `a_id` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `f_topic` longtext NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `s_unit_code` varchar(200) NOT NULL,
  `s_unit_name` varchar(200) NOT NULL,
  `f_no` varchar(200) NOT NULL,
  `f_date_posted` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4) ON UPDATE CURRENT_TIMESTAMP(4)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_forum`
--

INSERT INTO `lms_forum` (`f_id`, `a_id`, `i_id`, `f_topic`, `c_id`, `s_unit_code`, `s_unit_name`, `f_no`, `f_date_posted`) VALUES
(3, '1', '7', '<p><strong>1. What is Spring Boot? Why should you use it?</strong></p>\r\n\r\n<p><strong>2. What are some important features of using Spring Boot?</strong></p>\r\n\r\n<p><strong>3. What is auto-configuration in Spring boot? how does it help? Why Spring Boot is called opinionated?</strong></p>\r\n\r\n<p><strong>4. What is starter dependency in Spring Boot? how does it help?</strong></p>\r\n\r\n<p><strong>5. What is the difference between @SpringBootApplication and @EnableAutoConfiguration annotation?</strong></p>\r\n', '13', 'CS908', 'Spring Boot Framework Basics', '0VXQS9', '2020-02-08 10:59:04.4616');

-- --------------------------------------------------------

--
-- Table structure for table `lms_forum_discussions`
--

CREATE TABLE `lms_forum_discussions` (
  `fd_id` int(20) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `s_id` varchar(200) NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `f_topic` longtext NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `s_unit_code` varchar(200) NOT NULL,
  `s_unit_name` varchar(200) NOT NULL,
  `f_no` varchar(200) NOT NULL,
  `f_id` varchar(200) NOT NULL,
  `f_ans` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_forum_discussions`
--

INSERT INTO `lms_forum_discussions` (`fd_id`, `i_id`, `s_id`, `s_name`, `f_topic`, `c_id`, `s_unit_code`, `s_unit_name`, `f_no`, `f_id`, `f_ans`) VALUES
(8, '7', '7', 'Student One', '<br />\r\n<b>Notice</b>:  Trying to get property of non-object in <b>/opt/lampp/htdocs/LMS/student/pages_student_join_forum.php</b> on line <b>187</b><br />\r\n', '13', 'Spring Boot Framework Basics', 'Spring Boot Framework Basics', '0VXQS9', '3', '<p><strong>1. What is Spring Boot? Why should you use it?</strong><br />\r\nSpring Boot is another Java framework from Sring umbrella which aims to simplify the use of Spring Framework for Java development. It removes most of the pain associated with dealing with Spring e.g. a lot of configuration and dependencies and a lot of manual setups.<br />\r\n<br />\r\nWhy should you use it? Well, Spring Boot not only provides a lot of convenience by auto-configuration a lot of things for you but also improves the productivity because it lets you focus only on writing your business logic.<br />\r\n<br />\r\nFor example, <em>you don&#39;t need to setup a Tomcat server</em> to run your web application. You can just write code and run it as Java application because it comes with an embedded Tomcat server. You can also create a JAR file or WAR file for deployment based on your convenience.<br />\r\n<br />\r\nIn short, there are many reasons to use Spring Boot. In fact, it&#39;s now the standard way to develop Java application with Spring framework.</p>\r\n'),
(9, '7', '7', 'Instructor One', '<br />\r\n<b>Notice</b>:  Trying to get property of non-object in <b>/opt/lampp/htdocs/LMS/Instructors/pages_ins_view_forum.php</b> on line <b>187</b><br />\r\n', '13', 'Spring Boot Framework Basics', 'Spring Boot Framework Basics', '0VXQS9', '3', '<p><strong>2. What are some important features of using Spring Boot?</strong><br />\r\nThis is a good subjective question and used by the interviewer to gauge the experience of</p>\r\n\r\n<p>a candidate with Spring Boot. Anyway, following are some of the important features of Spring Boot framework:<br />\r\n<br />\r\n<strong>1. Starter dependency</strong><br />\r\nThis feature aggregates common dependencies together. For example, if you want to</p>\r\n\r\n<p>develop Spring MVC based <a href=\"http://www.java67.com/2017/10/how-to-test-restful-web-services-using.html\" target=\"_blank\">RESTful services</a> then instead of including Spring MVC JAR</p>\r\n\r\n<p>and Jackson JAR file into classpath you can just specify spring-boot-web-starter and it</p>\r\n\r\n<p>will automatically download both those JAR files. Spring Boot comes with many such</p>\r\n\r\n<p>starter dependencies to improve productivity.<br />\r\n<br />\r\n<strong>2. Auto-Configuration</strong><br />\r\nThis is another awesome features of Spring Boot which can configure many things</p>\r\n\r\n<p>for you. For example, If you are developing Spring web application and <span style=\"font-family:&quot;courier new&quot;,&quot;courier&quot;,monospace\">Thymeleaf</span></p>\r\n\r\n<p><span style=\"font-family:&quot;courier new&quot;,&quot;courier&quot;,monospace\">.jar</span> is present on the classpath then it can automatically configure Thymeleaf</p>\r\n\r\n<p>template resolver, view resolver, and other settings. A good knowledge of</p>\r\n\r\n<p>auto-configuration is required to become an experienced Spring Boot developers.<br />\r\n<br />\r\n<strong>3. Spring Initializer</strong><br />\r\nA web application which can create initial project structure for you. This simplifies initial project setup part.<br />\r\n<br />\r\n<strong>4. Spring Actuator</strong><br />\r\nThis feature provides a lot of insights of a running Spring boot application.</p>\r\n\r\n<p>For example, you can use <span style=\"font-family:Courier New,Courier,monospace\">Actuator</span> to find out which beans are created in</p>\r\n\r\n<p>Spring&#39;s application context and which request path are mapped to controllers.<br />\r\n<br />\r\n<strong>5. Spring CLI</strong><br />\r\nThis is another awesome feature of Spring Boot which really takes Spring</p>\r\n\r\n<p>development into next level. It allows you to use Groovy for writing Spring</p>\r\n\r\n<p>boot application which means a lot more concise code.<br />\r\n<br />\r\nIf you are interested in learning more about these essential Spring Boot</p>\r\n\r\n<p>features then Dan Vega&#39;s <strong><a href=\"https://click.linksynergy.com/fs-bin/click?id=JVFxdTr9V80&amp;subid=0&amp;offerid=323058.1&amp;type=10&amp;tmpid=14538&amp;RD_PARM1=https%3A%2F%2Fwww.udemy.com%2Fspring-boot-intro%2F\" rel=\"nofollow\" target=\"_blank\">Learn Spring Boot - Rapid Spring Application Development</a></strong></p>\r\n\r\n<p>is a great place to start with.<br />\r\n<br />\r\n&nbsp;</p>\r\n'),
(10, '7', '7', 'Student One', '<br />\r\n<b>Notice</b>:  Trying to get property of non-object in <b>/opt/lampp/htdocs/LMS/student/pages_student_join_forum.php</b> on line <b>187</b><br />\r\n', '13', 'Spring Boot Framework Basics', 'Spring Boot Framework Basics', '0VXQS9', '3', '<p><strong>2. What are some important features of using Spring Boot?</strong><br />\r\nThis is a good subjective question and used by the interviewer to gauge the experience of a candidate with Spring Boot. Anyway, following are some of the important features of Spring Boot framework:<br />\r\n<br />\r\n<strong>1. Starter dependency</strong><br />\r\nThis feature aggregates common dependencies together. For example, if you want to develop Spring MVC based <a href=\"http://www.java67.com/2017/10/how-to-test-restful-web-services-using.html\" target=\"_blank\">RESTful services</a> then instead of including Spring MVC JAR and Jackson JAR file into classpath you can just specify spring-boot-web-starter and it will automatically download both those JAR files. Spring Boot comes with many such starter dependencies to improve productivity.<br />\r\n<br />\r\n<strong>2. Auto-Configuration</strong><br />\r\nThis is another awesome features of Spring Boot which can configure many things for you. For example, If you are developing Spring web application and <span style=\"font-family:&quot;courier new&quot;,&quot;courier&quot;,monospace\">Thymeleaf.jar</span> is present on the classpath then it can automatically configure Thymeleaf template resolver, view resolver, and other settings. A good knowledge of auto-configuration is required to become an experienced Spring Boot developers.<br />\r\n<br />\r\n<strong>3. Spring Initializer</strong><br />\r\nA web application which can create initial project structure for you. This simplifies initial project setup part.<br />\r\n<br />\r\n<strong>4. Spring Actuator</strong><br />\r\nThis feature provides a lot of insights of a running Spring boot application. For example, you can use <span style=\"font-family:Courier New,Courier,monospace\">Actuator</span> to find out which beans are created in Spring&#39;s application context and which request path are mapped to controllers.<br />\r\n<br />\r\n<strong>5. Spring CLI</strong><br />\r\nThis is another awesome feature of Spring Boot which really takes Spring development into next level. It allows you to use Groovy for writing Spring boot application which means a lot more concise code.<br />\r\n<br />\r\nIf you are interested in learning more about these essential Spring Boot features then Dan Vega&#39;s <strong><a href=\"https://click.linksynergy.com/fs-bin/click?id=JVFxdTr9V80&amp;subid=0&amp;offerid=323058.1&amp;type=10&amp;tmpid=14538&amp;RD_PARM1=https%3A%2F%2Fwww.udemy.com%2Fspring-boot-intro%2F\" rel=\"nofollow\" target=\"_blank\">Learn Spring Boot - Rapid Spring Application Development</a> </strong>is a great place to start with.<br />\r\n<br />\r\n&nbsp;</p>\r\n'),
(11, '7', '7', 'Student One', '<br />\r\n<b>Notice</b>:  Trying to get property of non-object in <b>/opt/lampp/htdocs/LMS/student/pages_student_join_forum.php</b> on line <b>187</b><br />\r\n', '13', 'Spring Boot Framework Basics', 'Spring Boot Framework Basics', '0VXQS9', '3', '<p><strong>3. What is auto-configuration in Spring boot? how does it help? Why Spring Boot is called opinionated?</strong><br />\r\nThere are a lot of questions in this one question itself, but let&#39;s first tackle auto-configuration. As explained in the previous example, it automatically configures a lot of things based upon what is present in the classpath.<br />\r\n<br />\r\nFor example, it can configure <span style=\"font-family:&quot;courier new&quot;,&quot;courier&quot;,monospace\">JdbcTemplate</span> if its present and a <span style=\"font-family:&quot;courier new&quot;,&quot;courier&quot;,monospace\">DataSource</span> bean are available in the classpath. It can even do some basic web security stuff if Spring security is present in the classpath.<br />\r\n<br />\r\nBtw, if you are not familiar with spring security library then check out <a href=\"https://courses.baeldung.com/p/learn-spring-security-the-master-class?utm_source=javarevisited&amp;utm_medium=web&amp;utm_campaign=lss&amp;affcode=22136_bkwjs9xa\" rel=\"nofollow\" target=\"_blank\">Spring Security Masterclass</a> to learn more about it. It&#39;s one of the most important tools to secure modern-day Java application.<br />\r\n<br />\r\nAnyway, the point is auto-configuration does a lot of work for you with respect to configuring beans, controllers, view resolvers etc, hence it helps a lot in creating a Java application.<br />\r\n<br />\r\nNow, the big questions come, why it&#39;s considered opinionated? Well because it makes a judgment on its own. Sometimes it imports things which you don&#39;t want, but don&#39;t worry, Spring Boot also provides ways to override auto-configuration settings.<br />\r\n<br />\r\nIt&#39;s also disabled by default and you need to use either <span style=\"font-family:&quot;courier new&quot;,&quot;courier&quot;,monospace\">@SpringBootApplication</span> or <span style=\"font-family:&quot;courier new&quot;,&quot;courier&quot;,monospace\">@EnableAutoConfiguration</span> annotations on the Main class to enable the auto-configuration feature. See <a href=\"https://click.linksynergy.com/fs-bin/click?id=JVFxdTr9V80&amp;subid=0&amp;offerid=323058.1&amp;type=10&amp;tmpid=14538&amp;RD_PARM1=https%3A%2F%2Fwww.udemy.com%2Fspring-boot-essentials%2F\" rel=\"nofollow\" target=\"_blank\">Spring Boot Essentials</a> for learning more about them.<br />\r\n&nbsp;</p>\r\n'),
(12, '7', '7', 'Student One', '<p><strong>1. What is Spring Boot? Why should you use it?</strong></p>\r\n\r\n<p><strong>2. What are some important features of using Spring Boot?</strong></p>\r\n\r\n<p><strong>3. What is auto-configuration in Spring boot? how does it help? Why Spring Boot is called opinionated?</strong></p>\r\n\r\n<p><strong>4. What is starter dependency in Spring Boot? how does it help?</strong></p>\r\n\r\n<p><strong>5. What is the difference between @SpringBootApplication and @EnableAutoConfiguration annotation?</strong></p>\r\n', '13', 'Spring Boot Framework Basics', 'Spring Boot Framework Basics', '0VXQS9', '3', '<p><strong>What is starter dependency in Spring Boot? how does it help?</strong><br />\r\nThis question is generally asked as a follow-up of the previous question</p>\r\n\r\n<p>as it&#39;s quite similar to auto-configuration and many developers get</p>\r\n\r\n<p>confused between both of them. As the name suggests,</p>\r\n\r\n<p>starter dependency deal with dependency management.<br />\r\n<br />\r\nAfter examining several Spring-based projects Spring guys</p>\r\n\r\n<p>notice that there is always some set of libraries which are</p>\r\n\r\n<p>used together e.g. <a href=\"http://javarevisited.blogspot.sg/2018/01/7-reasons-for-using-spring-to-develop-RESTful-web-service.html#axzz55a8rTeu7\" target=\"_blank\">Spring MVC</a> with <a href=\"http://javarevisited.blogspot.sg/2018/01/how-to-ignore-unknown-properties-parsing-json-java-jackson.html\" target=\"_blank\">Jackson</a> for creating RESTful</p>\r\n\r\n<p>web services. Since declaring a dependency in Maven&#39;s <span style=\"font-family:&quot;courier new&quot;,&quot;courier&quot;,monospace\">pom.xml</span></p>\r\n\r\n<p>is the pain, they combined many libraries into one based upon</p>\r\n\r\n<p>functionality and created this starter package.<br />\r\n<br />\r\nThis not only frees you from declaring many dependencies</p>\r\n\r\n<p>but also fees you from compatibility and version mismatch</p>\r\n\r\n<p>issue. Spring Boot starter automatically pulls compatible</p>\r\n\r\n<p>version of other libraries so that you can use them</p>\r\n\r\n<p>without worrying about any compatibility issue.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `lms_instructor`
--

CREATE TABLE `lms_instructor` (
  `i_id` int(20) NOT NULL,
  `i_number` varchar(200) NOT NULL,
  `i_name` varchar(200) NOT NULL,
  `i_email` varchar(200) NOT NULL,
  `i_phone` varchar(200) NOT NULL,
  `i_pwd` varchar(200) NOT NULL,
  `i_dpic` varchar(200) NOT NULL,
  `i_bio` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_instructor`
--

INSERT INTO `lms_instructor` (`i_id`, `i_number`, `i_name`, `i_email`, `i_phone`, `i_pwd`, `i_dpic`, `i_bio`) VALUES
(7, 'BD4NKJWI', 'Instructor One', 'io@gmail.com', '+25410908978', 'e0ec30792753894eb3ed855f5ddccd408a506697', '6296727a-d38c-40b4-8ffe-dbec5cd1b289-getty-954967324.jpg', '<div id=\"DIV_7\">\r\n<div id=\"DIV_8\"><span style=\"font-size:16px\"><strong>Professional Summary</strong></span></div>\r\n\r\n<p>Creative graphic designer with innovative ideas and a unique approach to visuals. More than seven years of experience developing designs for print media, online websites, video, and advertising. Solid understanding of marketing principles and advertising techniques. Great attention to detail and a talent for creating memorable visual designs. Enthusiastic team player who is committed to delivering top results on time and within the budget. Passion for keeping clients satisfied with each project.</p>\r\n</div>\r\n\r\n<div id=\"DIV_10\">\r\n<div id=\"DIV_11\"><strong><span style=\"font-size:14px\">Skills</span></strong></div>\r\n\r\n<div id=\"LI_13\">\r\n<ul>\r\n	<li>-Proficient in all major computer design software including Adobe Photoshop, Adobe Illustrator, Adobe Flash, Adobe Fireworks, Adobe Dreamweaver, Microsoft Visio, and Macromedia HomeSite. -Strong base of knowledge and skill in all elements of design, visual layout, typography, color, and drawing techniques. -Excellent media and technology skills related to internet marketing, web design, online message platforms, and more. -Top written and oral communication skills allowing for more productive conversations with clients and colleagues. -Committed to delivering strong customer service to each client and dedicating myself to a project until the client is pleased.</li>\r\n</ul>\r\n</div>\r\n\r\n<ul>\r\n</ul>\r\n</div>\r\n\r\n<div id=\"DIV_20\">\r\n<div>&nbsp;</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div id=\"DIV_21\"><span style=\"font-size:14px\">Work Experience</span></div>\r\n\r\n<div id=\"DIV_22\">\r\n<div id=\"DIV_23\"><span style=\"font-size:14px\">Graphic Designer</span></div>\r\n\r\n<div id=\"DIV_24\"><span style=\"font-size:14px\">May 2015 &ndash; present</span></div>\r\n&nbsp;\r\n\r\n<div id=\"DIV_26\">&nbsp;</div>\r\n\r\n<div id=\"DIV_27\">&nbsp;</div>\r\n</div>\r\n&nbsp;\r\n\r\n<div id=\"LI_33\">\r\n<ul>\r\n	<li>Discuss project ideas and goals with each client, and turn these visions into real visual designs that meet the need using illustrations, artwork, design elements, and fonts.</li>\r\n	<li>Create original rich images for company clients using various types of computer software for graphic design.</li>\r\n	<li>Deliver top projects that please clients and attract new business, with a 14% increase in client referral rate.</li>\r\n</ul>\r\n</div>\r\n\r\n<ul>\r\n</ul>\r\n&nbsp;\r\n\r\n<div id=\"DIV_38\">\r\n<div id=\"DIV_39\">Graphic Designer</div>\r\n\r\n<div id=\"DIV_40\">September 2013 &ndash; May 2015</div>\r\n&nbsp;\r\n\r\n<div id=\"DIV_42\">&nbsp;</div>\r\n\r\n<div id=\"DIV_43\">&nbsp;</div>\r\n&nbsp;\r\n\r\n<div id=\"DIV_47\">&nbsp;</div>\r\n\r\n<div id=\"LI_49\">\r\n<ul>\r\n	<li>Met with clients, listened to their objectives for the look of their website, and developed a prototype design to fit the requirements.</li>\r\n	<li>Revised prototype web designs after client review and specific feedback until the final look was achieved.</li>\r\n	<li>Recognized by company as having an excellent client satisfaction rate, and awarded with top design achievement medal from the industry.</li>\r\n</ul>\r\n</div>\r\n\r\n<ul>\r\n</ul>\r\n&nbsp;\r\n\r\n<div id=\"DIV_54\">\r\n<div id=\"DIV_55\">Graphic Designer</div>\r\n\r\n<div id=\"DIV_56\">December 2010 &ndash; September 2013</div>\r\n&nbsp;\r\n\r\n<div id=\"DIV_58\">&nbsp;</div>\r\n\r\n<div id=\"DIV_59\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"DIV_63\">&nbsp;</div>\r\n\r\n<div id=\"LI_65\">\r\n<ul>\r\n	<li>Designed company logos for various types of organizations in a variety of industries based on line of work, corporate personality, and client preferences.</li>\r\n	<li>Arranged photographs, illustrations, and other design pieces to convey a specific look for a company website.</li>\r\n	<li>Brought in more than $750,000 in revenue during tenure with a marketing firm based on proven results and solid, effective design work.</li>\r\n</ul>\r\n</div>\r\n\r\n<ul>\r\n</ul>\r\n</div>\r\n\r\n<div id=\"DIV_70\">\r\n<div id=\"DIV_71\">Education</div>\r\n\r\n<div id=\"DIV_72\">\r\n<div id=\"DIV_73\">Internship-Graphic Design</div>\r\n\r\n<div id=\"DIV_74\">2010</div>\r\n&nbsp;\r\n\r\n<div id=\"DIV_76\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"DIV_77\">Stone Marketing Team</div>\r\n\r\n<div id=\"DIV_78\">Newark Delaware</div>\r\n\r\n<div id=\"DIV_72\">\r\n<div id=\"DIV_73\">Bachelor of Arts in Graphic Design</div>\r\n\r\n<div id=\"DIV_74\">2010</div>\r\n&nbsp;\r\n\r\n<div id=\"DIV_76\">&nbsp;</div>\r\n</div>\r\n\r\n<div id=\"DIV_77\">University of Delaware</div>\r\n\r\n<div id=\"DIV_78\">Dover Delaware</div>\r\n</div>\r\n\r\n<div id=\"DIV_7\">\r\n<div id=\"DIV_8\">Hobbies and Interests</div>\r\n\r\n<p>I have a strong interest in visual arts beyond graphic design. I am also a skilled painter, sculptor, and drawer. I have had several of my pieces displayed in local art shows and galleries, and work on custom commissioned pieces for people from time to time. Additionally, I have an interest in interior design and enjoy reading about elements of room decor.</p>\r\n</div>\r\n</div>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `lms_messanges`
--

CREATE TABLE `lms_messanges` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` longtext NOT NULL,
  `msg` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_messanges`
--

INSERT INTO `lms_messanges` (`id`, `name`, `email`, `subject`, `msg`) VALUES
(2, 'Dummy User', 'demo@gmail.com', 'Test messange', 'Hey there this is a test messange');

-- --------------------------------------------------------

--
-- Table structure for table `lms_paid_study_materials`
--

CREATE TABLE `lms_paid_study_materials` (
  `psm_id` int(20) NOT NULL,
  `ls_id` int(20) NOT NULL,
  `c_code` varchar(200) NOT NULL,
  `sm_number` varchar(200) NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `cc_id` varchar(200) NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `c_category` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `i_name` varchar(200) NOT NULL,
  `p_method` varchar(200) NOT NULL,
  `p_code` varchar(200) NOT NULL,
  `p_amt` varchar(200) NOT NULL,
  `p_date_paid` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP(4) ON UPDATE CURRENT_TIMESTAMP(4),
  `s_id` varchar(200) NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `s_regno` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_paid_study_materials`
--

INSERT INTO `lms_paid_study_materials` (`psm_id`, `ls_id`, `c_code`, `sm_number`, `c_id`, `cc_id`, `c_name`, `c_category`, `i_id`, `i_name`, `p_method`, `p_code`, `p_amt`, `p_date_paid`, `s_id`, `s_name`, `s_regno`) VALUES
(7, 16, 'CS908', 'C2B03TF194', '13', '5', 'Spring Boot Framework Basics', 'Computer Science', '7', 'Instructor One', 'Mpesa', 'OA900IOP1T', '4500', '2020-02-08 10:53:22.9013', '7', 'Student One', 'CSC900167');

-- --------------------------------------------------------

--
-- Table structure for table `lms_pwdresets`
--

CREATE TABLE `lms_pwdresets` (
  `id` int(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_pwdresets`
--

INSERT INTO `lms_pwdresets` (`id`, `email`, `token`) VALUES
(1, 'sysadmin@lms.com', 'E1TVZU7WJX');

-- --------------------------------------------------------

--
-- Table structure for table `lms_questions`
--

CREATE TABLE `lms_questions` (
  `q_id` int(20) NOT NULL,
  `q_code` varchar(200) NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `cc_id` varchar(200) NOT NULL,
  `c_code` varchar(200) NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `q_details` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_questions`
--

INSERT INTO `lms_questions` (`q_id`, `q_code`, `c_id`, `cc_id`, `c_code`, `c_name`, `i_id`, `q_details`) VALUES
(10, 'QNS-WDOS', '13', '5', 'CS908', 'Spring Boot Framework Basics', '7', '<ul>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question1\"><strong>Q 1. What does Spring Boot mean?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question2\"><strong>Q 2. What are the various Advantages Of Using Spring Boot?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question3\"><strong>Q 3. What are the various features of Spring Boot?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question4\"><strong>Q 4. What is the reason to have a spring-boot-maven module?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question5\"><strong>Q 5. How to make Spring Boot venture utilizing Spring Initializer?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question6\"><strong>Q 6. What do Dev Tools in Spring boot mean?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question7\"><strong>Q 7. What does Spring Boot Starter Pom mean? Why Is It Useful?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question8\"><strong>Q 8. What does Actuator in Spring Boot mean?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question9\"><strong>Q 9. What Is the Configuration File Name Used By Spring Boot?</strong></a></li>\r\n	<li><a href=\"https://www.onlineinterviewquestions.com/spring-boot-interview-questions/#question10\"><strong>Q 10. Why in spring boot &ldquo;Opinionated &rdquo; is used?</strong></a></li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `lms_results`
--

CREATE TABLE `lms_results` (
  `rs_id` int(20) NOT NULL,
  `rs_code` varchar(200) NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `s_regno` varchar(200) NOT NULL,
  `s_id` varchar(200) NOT NULL,
  `s_unit_code` varchar(200) NOT NULL,
  `s_unit_name` varchar(200) NOT NULL,
  `i_name` varchar(200) NOT NULL,
  `cc_id` varchar(200) NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `c_eos_marks` varchar(200) NOT NULL,
  `c_cat1_marks` varchar(200) NOT NULL,
  `c_cat2_marks` varchar(200) NOT NULL,
  `c_date_added` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_results`
--

INSERT INTO `lms_results` (`rs_id`, `rs_code`, `s_name`, `s_regno`, `s_id`, `s_unit_code`, `s_unit_name`, `i_name`, `cc_id`, `c_id`, `i_id`, `c_eos_marks`, `c_cat1_marks`, `c_cat2_marks`, `c_date_added`) VALUES
(13, 'WQZU087D', 'Student One', 'CSC900167', '7', 'CS908', 'Spring Boot Framework Basics', 'Instructor One', '5', '13', '7', '50', '9', '10', '2020-02-08 10:56:12.310335');

-- --------------------------------------------------------

--
-- Table structure for table `lms_student`
--

CREATE TABLE `lms_student` (
  `s_id` int(20) NOT NULL,
  `s_regno` varchar(200) NOT NULL,
  `s_course` varchar(2000) NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `s_email` varchar(200) NOT NULL,
  `s_pwd` varchar(200) NOT NULL,
  `s_phoneno` varchar(200) NOT NULL,
  `s_dob` varchar(200) NOT NULL,
  `s_gender` varchar(200) NOT NULL,
  `s_dpic` varchar(200) NOT NULL,
  `s_acc_stats` varchar(200) NOT NULL,
  `s_bio` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_student`
--

INSERT INTO `lms_student` (`s_id`, `s_regno`, `s_course`, `s_name`, `s_email`, `s_pwd`, `s_phoneno`, `s_dob`, `s_gender`, `s_dpic`, `s_acc_stats`, `s_bio`) VALUES
(7, 'CSC900167', 'Computer Science', 'Student One', 's1@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', '+254737229776', '12/9/2000', 'Male', 'index.jpeg', 'Approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `lms_study_material`
--

CREATE TABLE `lms_study_material` (
  `ls_id` int(20) NOT NULL,
  `c_code` varchar(200) NOT NULL,
  `sm_number` varchar(200) NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `cc_id` varchar(200) NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `c_category` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `i_name` varchar(200) NOT NULL,
  `sm_materials` longtext NOT NULL,
  `sm_price` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_study_material`
--

INSERT INTO `lms_study_material` (`ls_id`, `c_code`, `sm_number`, `c_id`, `cc_id`, `c_name`, `c_category`, `i_id`, `i_name`, `sm_materials`, `sm_price`) VALUES
(16, 'CS908', 'C2B03TF194', '13', '5', 'Spring Boot Framework Basics', 'Computer Science', '7', 'Instructor One', 'spring-boot-reference.pdf', '4500'),
(17, 'IT2089', 'M856XL9FZW', '12', '4', 'Object Oriented Programming', 'Information Technology', '7', 'Instructor One', 'OBJECT ORIENTED CONCEPTS AND EXAMPLES.pdf', '9000');

-- --------------------------------------------------------

--
-- Table structure for table `lms_units_assaigns`
--

CREATE TABLE `lms_units_assaigns` (
  `ua_id` int(20) NOT NULL,
  `c_code` varchar(200) NOT NULL,
  `c_id` varchar(200) NOT NULL,
  `cc_id` varchar(200) NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `c_category` varchar(200) NOT NULL,
  `i_id` varchar(200) NOT NULL,
  `i_number` varchar(200) NOT NULL,
  `i_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_units_assaigns`
--

INSERT INTO `lms_units_assaigns` (`ua_id`, `c_code`, `c_id`, `cc_id`, `c_name`, `c_category`, `i_id`, `i_number`, `i_name`) VALUES
(16, 'IT2089', '12', '4', 'Object Oriented Programming ', 'Information Technology', '7', 'BD4NKJWI', 'Instructor One'),
(17, 'CS908', '13', '5', 'Spring Boot Framework Basics', 'Computer Science', '7', 'BD4NKJWI', 'Instructor One');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lms-course_work`
--
ALTER TABLE `lms-course_work`
  ADD PRIMARY KEY (`cw_id`);

--
-- Indexes for table `lms_admin`
--
ALTER TABLE `lms_admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `lms_answers`
--
ALTER TABLE `lms_answers`
  ADD PRIMARY KEY (`an_id`);

--
-- Indexes for table `lms_billings`
--
ALTER TABLE `lms_billings`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `lms_certs`
--
ALTER TABLE `lms_certs`
  ADD PRIMARY KEY (`cert_id`);

--
-- Indexes for table `lms_course`
--
ALTER TABLE `lms_course`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `lms_course_categories`
--
ALTER TABLE `lms_course_categories`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `lms_enrollments`
--
ALTER TABLE `lms_enrollments`
  ADD PRIMARY KEY (`en_id`);

--
-- Indexes for table `lms_forum`
--
ALTER TABLE `lms_forum`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `lms_forum_discussions`
--
ALTER TABLE `lms_forum_discussions`
  ADD PRIMARY KEY (`fd_id`);

--
-- Indexes for table `lms_instructor`
--
ALTER TABLE `lms_instructor`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `lms_messanges`
--
ALTER TABLE `lms_messanges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_paid_study_materials`
--
ALTER TABLE `lms_paid_study_materials`
  ADD PRIMARY KEY (`psm_id`);

--
-- Indexes for table `lms_pwdresets`
--
ALTER TABLE `lms_pwdresets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_questions`
--
ALTER TABLE `lms_questions`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `lms_results`
--
ALTER TABLE `lms_results`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `lms_student`
--
ALTER TABLE `lms_student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `lms_study_material`
--
ALTER TABLE `lms_study_material`
  ADD PRIMARY KEY (`ls_id`);

--
-- Indexes for table `lms_units_assaigns`
--
ALTER TABLE `lms_units_assaigns`
  ADD PRIMARY KEY (`ua_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lms-course_work`
--
ALTER TABLE `lms-course_work`
  MODIFY `cw_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lms_admin`
--
ALTER TABLE `lms_admin`
  MODIFY `a_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lms_answers`
--
ALTER TABLE `lms_answers`
  MODIFY `an_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lms_billings`
--
ALTER TABLE `lms_billings`
  MODIFY `b_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lms_certs`
--
ALTER TABLE `lms_certs`
  MODIFY `cert_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lms_course`
--
ALTER TABLE `lms_course`
  MODIFY `c_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lms_course_categories`
--
ALTER TABLE `lms_course_categories`
  MODIFY `cc_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lms_enrollments`
--
ALTER TABLE `lms_enrollments`
  MODIFY `en_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `lms_forum`
--
ALTER TABLE `lms_forum`
  MODIFY `f_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lms_forum_discussions`
--
ALTER TABLE `lms_forum_discussions`
  MODIFY `fd_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lms_instructor`
--
ALTER TABLE `lms_instructor`
  MODIFY `i_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lms_messanges`
--
ALTER TABLE `lms_messanges`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lms_paid_study_materials`
--
ALTER TABLE `lms_paid_study_materials`
  MODIFY `psm_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lms_pwdresets`
--
ALTER TABLE `lms_pwdresets`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lms_questions`
--
ALTER TABLE `lms_questions`
  MODIFY `q_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lms_results`
--
ALTER TABLE `lms_results`
  MODIFY `rs_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lms_student`
--
ALTER TABLE `lms_student`
  MODIFY `s_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lms_study_material`
--
ALTER TABLE `lms_study_material`
  MODIFY `ls_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `lms_units_assaigns`
--
ALTER TABLE `lms_units_assaigns`
  MODIFY `ua_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
