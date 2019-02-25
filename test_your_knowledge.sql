-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 16, 2019 at 07:08 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_your_knowledge`
--
CREATE DATABASE IF NOT EXISTS `test_your_knowledge` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test_your_knowledge`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_categories`
--

DROP TABLE IF EXISTS `tb_categories`;
CREATE TABLE IF NOT EXISTS `tb_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_categories`
--

INSERT INTO `tb_categories` (`id`, `name`, `createdDate`, `modifiedDate`) VALUES
(1, 'PMP', '2019-02-04 22:07:28', '2019-02-16 02:32:21'),
(2, 'Java', '2019-02-04 22:07:28', '2019-02-04 22:07:28'),
(3, 'Math', '2019-02-09 02:27:11', '2019-02-09 02:33:43'),
(4, 'Mobile Development', '2019-02-16 05:32:14', '2019-02-16 05:33:45'),
(5, 'Web Development', '2019-02-16 05:32:34', '2019-02-16 05:32:34'),
(6, 'Responsive Web', '2019-02-16 05:35:34', '2019-02-16 05:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_questions`
--

DROP TABLE IF EXISTS `tb_questions`;
CREATE TABLE IF NOT EXISTS `tb_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `option1` longtext NOT NULL,
  `option2` longtext NOT NULL,
  `option3` longtext NOT NULL,
  `option4` longtext NOT NULL,
  `correctOption` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_questions`
--

INSERT INTO `tb_questions` (`id`, `idTest`, `question`, `option1`, `option2`, `option3`, `option4`, `correctOption`, `status`, `createdDate`, `modifiedDate`) VALUES
(1, 1, 'Being assigned as a project manager, you noticed during project execution that conflicts arise in the team on both technical and interpersonal levels. What is an appropriate way of handling conflicts?', 'Conflicts distract the team and disrupt the work rhythm. You should always smooth them when they surface.', 'A conflict should be handled in a meeting so that the entire team can participate in finding a solution.', 'Conflicts should be addressed early and usually in private, using a direct, collaborative approach.', 'You should use your coercive power to quickly resolve conflicts and then focus on goal achievement.', 'option3', 1, '2019-02-03 19:50:50', '2019-02-04 02:15:26'),
(2, 1, 'What is the purpose of a project charter?', 'To formally authorize a project or a phase and document initial requirements which satisfy the stakeholder’s needs and expectations.', 'To document how the project will be planned, executed, monitored/controlled, and closed.', 'To link the project, which is going to be planned, executed, and monitored/controlled to the ongoing work of the organization.', 'To describe the process of performing the work defined in the project management plan in order to achieve the project’s objectives.', 'option1', 1, '2019-02-03 19:56:55', '2019-02-04 02:16:31'),
(3, 1, 'The concept of (the) _________ states that changes related to one requirement—scope, time, or cost—will at least influence one other element.                                                      ', 'Three-point estimation', 'Triple constraint', 'Three wise men', 'Three needs theory', 'option2', 1, '2019-02-03 22:28:33', '2019-02-04 02:17:39'),
(4, 6, '&lt;p&gt;Which statement is true?&lt;/p&gt;', '&lt;p&gt;Coupling is the &lt;strong&gt;OO principle most closely associated&lt;/strong&gt; with hiding a class’s implementation details.&lt;/p&gt;', '&lt;p&gt;Coupling is the OO principle most closely associated with making sure classes know about other classes only through their APIs.&lt;/p&gt;', '&lt;p&gt;Coupling is the OO principle most closely associated with making sure a class is designed with a single, well-focused purpose.&lt;/p&gt;', '&lt;p&gt;Coupling is the OO principle most closely associated with allowing a single object to be seen as having many types.&lt;/p&gt;', 'option2', 1, '2019-02-04 00:27:39', '2019-02-13 03:26:12'),
(5, 6, 'Which statement is true?', 'A given TreeSet’s ordering cannot be changed once it’s created.', 'The java.util.Properties class is conceptually more like a List than like a Map.', 'Of the main types of collections flavors (Lists, Sets, Maps), Queues are conceptually most like Sets.', 'It’s programmatically easier to perform a non-destructive traversal of a PriorityQueue than a LinkedList.', 'option1', 1, '2019-02-04 00:34:02', '2019-02-04 00:34:39'),
(6, 6, 'When using the java.io.Console class, which is true?', 'Objects of type java.io.Console are created using a constructor from the same class.', 'Objects of type java.io.Console are created using a method from the java.io.File class.', 'Objects of type java.io.Console are created using a method from the java.lang.System class.', 'Objects of type java.io.Console are created using a method from the java.lang.Object class.', 'option3', 1, '2019-02-04 00:36:14', '2019-02-04 00:36:14'),
(7, 6, '&lt;p&gt;Given a partial API, Final class Items implements no interfaces and has one constructor:&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Items(String name, int value);&lt;/strong&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;And given that you want to make collections of Items objects and sort them (using classes and interfaces in java.lang or java.util), sometimes by name, and sometimes by value, which is true?&lt;/p&gt;', 'It’s likely that you’ll use the Arrays class.', 'It’s likely that you’ll use the Collections class.', 'It’s likely that you’ll implement Comparable at least twice.', 'It’s likely that you’ll implement the compareTo() method at least twice.', 'option2', 1, '2019-02-04 00:40:42', '2019-02-13 03:04:44'),
(8, 6, 'Concerning Java’s Garbage Collector (GC), which is true?', 'If Object X has a reference to Object Y, then Object Y cannot be GCed.', 'If the GC decides to delete an object, and if finalize() has never been invoked for that object, it is guaranteed that the GC will invoke finalize() for that object before the object is deleted.', 'Once the GC invokes finalize() on an object, it is guaranteed that the GC will delete that object once finalize() has completed.', 'When the GC runs, it decides whether to remove objects from the heap, the stack, or both.', 'option2', 1, '2019-02-04 00:44:19', '2019-02-04 00:44:19'),
(9, 6, 'Which statement is true?', 'A single JAR file can contain only files from a single package.', 'A JAR file can be used only on the machine on which it was created.', 'When javac is using files within a JAR file, it will unJAR the file during compilation.', 'The Java SDK installation directory tree on a Java developer’s computer usually includes a subdirectory tree named jre/lib/ext.', 'option4', 1, '2019-02-04 00:46:58', '2019-02-04 00:46:58'),
(10, 6, '&lt;p&gt;Which, concerning command-line options, are true?&lt;/p&gt;', '&lt;p&gt;The &lt;strong&gt;-D&lt;/strong&gt; flag can be used with javac to set a system property.&lt;/p&gt;', '&lt;p&gt;The &lt;strong&gt;-d&lt;/strong&gt; flag can be used with java to disable assertions.&lt;/p&gt;', '&lt;p&gt;The &lt;strong&gt;-d&lt;/strong&gt; flag can be used with javac to specify where to place .class files.&lt;/p&gt;', '&lt;p&gt;The &lt;strong&gt;-d&lt;/strong&gt; flag can be used with javac to document the locations of deprecated APIs in source files.&lt;/p&gt;', 'option3', 1, '2019-02-04 00:47:56', '2019-02-13 03:26:46'),
(11, 6, '&lt;p&gt;Your company makes compute-intensive, 3D rendering software for the movie industry. Your chief scientist has just discovered a new algorithm for several key methods in a commonly used utility class. The new algorithm will decrease processing time by 15 percent, without having to change any method signatures. After you change these key methods, and in the course of rigorous system testing, you discover that the changes have introduced no new bugs into the software.&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;In terms of your software’s overall design, which is probably true?&lt;/p&gt;', 'Your software demonstrated low cohesion.', 'Your software demonstrated high cohesion.', 'Your software demonstrated loose coupling.', 'Your software demonstrated tight coupling.', 'option3', 1, '2019-02-04 00:49:50', '2019-02-13 03:03:47'),
(12, 6, 'Which is false about the classes and interfaces in java.util?', 'LinkedHashSet is-a Collection', 'Vector is-a List', 'LinkedList is-a Queue', 'LinkedHashMap is-a Collection', 'option4', 1, '2019-02-04 00:51:08', '2019-02-04 00:51:08'),
(13, 6, 'Which are not capabilities of Java’s assertion mechanism?', 'You can, at the command line, enable assertions for a specific class.', 'You can, at the command line, disable assertions for a specific package.', 'You can, at runtime, enable assertions for any version of Java.', 'You can programmatically test whether assertions have been enabled without throwing an AssertionError.', 'option3', 1, '2019-02-04 00:54:56', '2019-02-04 00:54:56'),
(14, 6, 'Which statement is true?', 'If class A has-a class B, then class A cannot be considered well encapsulated.', 'If class A is-a class B, then the two classes are said to be cohesive.', 'If class A has-a class B, then the two classes are said to be cohesive.', 'If class A is-a class B, it’s possible for them to still be loosely coupled.', 'option4', 1, '2019-02-04 00:58:51', '2019-02-04 00:58:51'),
(15, 6, 'Which statement is false?', 'If a class’s member’s values can be retrieved, but not changed, without using the class’s API, the class is not cohesive.', 'If a class’s member’s values can be retrieved, but not changed, without using the class’s API, tight coupling could occur.', 'If a class’s member’s values can be retrieved, but not changed, without using the class’s API, the class is not well encapsulated.', 'If a class’s member’s values can be updated only through the use of its API, or by an inner class, the class is well encapsulated.', 'option1', 1, '2019-02-04 01:00:53', '2019-02-04 01:00:53'),
(16, 6, '&lt;p&gt;Consider:&amp;nbsp;&lt;/p&gt;&lt;p&gt;- A and E are Classes;&amp;nbsp;&lt;/p&gt;&lt;p&gt;- B and D are interfaces;&amp;nbsp;&lt;/p&gt;&lt;p&gt;- C is an abstract class.&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;Which is false?&lt;/p&gt;', 'class F implements B ,C{ }', 'class F implements B{ }', 'class F extends E{ }', 'class F implements B,D{ }', 'option1', 1, '2019-02-04 01:07:42', '2019-02-13 03:05:54'),
(17, 6, 'Which statement is true?', 'Default constructor should be always there for any class.', 'Default constructor only contains \\\"this();\\\" .', 'When defining our own constructor we can\\\'t use any access modifier.', 'A constructor should not have a return type.', 'option4', 1, '2019-02-04 02:02:46', '2019-02-04 02:02:46'),
(18, 6, '&lt;p&gt;Consider following three statements:&amp;nbsp;&lt;/p&gt;&lt;p&gt;I. Overloaded method must change the argument list;&amp;nbsp;&lt;/p&gt;&lt;p&gt;II. Overloaded method may change the return type;&amp;nbsp;&lt;/p&gt;&lt;p&gt;III. Overloaded method may declare broader checked exception.&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;Which is true?&lt;/p&gt;', 'I only', 'II only', 'III only', 'All', 'option4', 1, '2019-02-04 02:04:13', '2019-02-13 03:03:23'),
(19, 6, '&lt;p&gt;Consider the following method:&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;public void method(int a){ }&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;Which is true?&lt;/p&gt;', 'This method can only invoke through an instance of enclosing class.', 'This method has marked with highest restrictive access modifier.', 'This method returns an int.', 'This method takes int array as argument.', 'option1', 1, '2019-02-04 02:05:17', '2019-02-13 03:06:24'),
(20, 6, '&lt;p&gt;Consider the following method:&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;static int min(double[] in){&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&amp;nbsp; &amp;nbsp; //codes&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;}&lt;/strong&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;Which is true?&lt;/p&gt;', 'This method is incorrect as it doesn\\\\\\\'t have access modifier.', 'This method has marked with static access modifier.', 'This method can be used to return the minimum value of an array.', 'None of above.', 'option4', 1, '2019-02-04 02:07:19', '2019-02-13 03:05:31'),
(21, 6, '&lt;p&gt;Which statement is true?&lt;/p&gt;', '&lt;p&gt;Low cohesion is better.&lt;/p&gt;', '&lt;p&gt;Loose coupling is bad.&lt;/p&gt;', '&lt;p&gt;High cohesion makes it easier to maintain program.&lt;/p&gt;', '&lt;p&gt;Tight coupling makes it easier to maintain program.&lt;/p&gt;', 'option3', 1, '2019-02-04 02:08:15', '2019-02-13 03:32:46'),
(22, 6, '&lt;p&gt;Which of the following is correct lambda expression?&lt;/p&gt;', '&lt;p&gt;Predicate filter = (c) -&amp;gt; {&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; return c.indexOf(&quot;a&quot;) &amp;gt; 0;&amp;nbsp;&lt;/p&gt;&lt;p&gt;};&lt;/p&gt;', '&lt;p&gt;Predicate filter = (c) -&amp;gt; return c.indexOf(&quot;a&quot;) &amp;gt; 0;&lt;/p&gt;', '&lt;p&gt;Predicate filter = (c) -&amp;gt; {&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; return c.indexOf(&quot;a&quot;);&lt;/p&gt;&lt;p&gt;};&lt;/p&gt;', '&lt;p&gt;Predicate filter = (c) -&amp;gt; {&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; return c.length();&lt;/p&gt;&lt;p&gt;};&lt;/p&gt;', 'option1', 1, '2019-02-04 02:09:03', '2019-02-13 03:28:11'),
(23, 6, '&lt;p&gt;Which of the following is a checked exception?&lt;/p&gt;', '&lt;p&gt;FileNotFoundException&lt;/p&gt;', '&lt;p&gt;ArithmeticException&amp;nbsp;&lt;/p&gt;', '&lt;p&gt;ClassCastException&lt;/p&gt;', '&lt;p&gt;NullPointerException&lt;/p&gt;', 'option1', 1, '2019-02-04 02:09:51', '2019-02-13 03:42:18'),
(24, 1, 'Your organization is considering to run a project which will entail an investment of $1,000,000. The product from the project is forecasted to create revenues of $250,000 in the first year after the end of the project and of $420,000 in each of the two following years. What is true for the net present value of the project over the three years cycle at a discount rate of 10%?', 'The net present value is positive, which makes the project attractive.', 'The net present value is positive, which makes the project unattractive.', 'The net present value is negative, which makes the project attractive.', 'The net present value is negative, which makes the project unattractive.', 'option4', 1, '2019-02-04 02:18:35', '2019-02-04 02:18:35'),
(25, 1, 'What does the term best practice often refer to?5', 'A standardized set of deliverables, like plans, reports, and checklists.', 'A set of tools and techniques that a project manager should master.', 'The concept of state of the art applied to project management.', 'A specific sequence of work, described in terms of soft logic.', 'option4', 1, '2019-02-04 02:19:16', '2019-02-04 02:19:16'),
(26, 1, 'The communications management plan is a document which includes descriptions of', 'Project level performance reports', 'Activity level status reports', 'Stakeholder communication requirements', 'Project benefit analysis results', 'option3', 1, '2019-02-04 02:20:10', '2019-02-04 02:20:10'),
(27, 1, '_________ are usually not a manifestation of unique organizational cultures and styles.', 'Shared visions, values, norms, beliefs, and expectations', 'Individual traits and attitudes of co-workers', 'Views of authority relationships', 'Policies, methods, and procedures', 'option2', 1, '2019-02-04 02:20:40', '2019-02-04 02:20:40'),
(28, 1, 'Which of the following is generally not regarded as an element of active listening?', 'Making eye contact', 'Paraphrasing', 'Interpreting the information', 'Interrupting when appropriate', 'option4', 1, '2019-02-04 02:21:34', '2019-02-04 02:21:34'),
(29, 1, 'As the project manager, you decided to arrange a team meeting to identify and analyze lessons learned from quality control with stakeholders. What should you do with them?', 'Document them and make them part of the historical database for the project and the performing organization.', 'Discuss them with management and make sure that they remain otherwise confidential', 'Publish them in the corporate newsletter.', 'Follow your strategic decisions, independent from lessons learned. These decisions have been made and should be implemented whatever the outcomes are.', 'option1', 1, '2019-02-04 02:22:24', '2019-02-04 02:22:24'),
(30, 1, 'Which of the following documents is not used as input for the validate scope process? ', 'The project management plan, containing the scope baseline consisting of the project scope statement and its associated WBS and WBS dictionary.', 'The verified deliverables, completed and checked for correctness by the Control quality process.', 'The requirements traceability matrix, linking requirements to their origin and tracing them throughout the project lifecycle.', 'The RACI matrix, describing accountabilities in case of product rejection.', 'option4', 1, '2019-02-04 02:23:11', '2019-02-04 02:23:11'),
(31, 1, 'How should change management be planned for?', 'Changes are generally not predictable, therefore planning for change management cannot be reasonable.', 'Planning for change management should be done while the various change control processes are being applied.', 'Change management can be planned in a set of management plans or a specific change management plan.', 'Changes are a sign of bad planning. One should avoid changes during a project, thus eliminating the need to manage them.', 'option3', 1, '2019-02-04 02:25:10', '2019-02-04 02:25:10'),
(32, 1, 'According to Bruce Tuckman, what are the stages of team development?', 'Honeymoon, rejection, regression, acceptance, re-entry', 'Forming, storming, norming, performing', 'Tell, sell, consult, join', 'Direct, support, coach, delegate', 'option2', 1, '2019-02-04 02:25:51', '2019-02-04 02:25:51'),
(33, 1, 'What is not a reason for companies to organize lessons learned?', 'Lessons learned databases are an essential element of the organizational process assets.', 'Lessons learned should focus on identifying those accountable for errors and failures.', 'Lessons learned sessions should bring about recommendations to improve future performance on projects.', 'Phase-end lessons learned sessions provide a good team building exercise for project staff members.', 'option2', 1, '2019-02-04 02:26:38', '2019-02-04 02:26:38'),
(34, 1, 'How does a project management team stay in touch with the work and the attitudes of project team members?', 'By observation and communication', 'Using closed questions during team meetings', 'Through third-party assessments', 'Through the team members’ functional managers', 'option1', 1, '2019-02-04 02:27:11', '2019-02-04 02:27:11'),
(35, 1, 'Which document is developed along the risk management processes from identify risks through plan and implement risk responses to monitor risks?', 'List of risk triggers', 'Risk register', 'Risk mitigation', 'Decision tree', 'option2', 1, '2019-02-04 02:27:48', '2019-02-04 02:27:48'),
(36, 1, 'A customer is requiring a minor scope change and expects you to do this without delays and additional costs. You believe that you have adequate authorization to make the decision by yourself, but you are not quite sure. What should be your next steps?', 'A requested change is always an opportunity to get more money paid by the customer and to secretly solve schedule and quality problems. You should make some reasonable estimates on time, costs, risks etc. and then add a nice margin on top of that to calculate the new price.', 'Customer satisfaction is your top priority. The customer gives you an opportunity to increase their satisfaction, which you should use to the maximum benefit. Most project managers have contingencies to cover risks; these can be used to pay the additional costs.', 'Before making a decision you should have a look at the customer’s parking lot. If you find there many expensive, new models, it is likely that you can use the requested change to increase the profit from the contract. Otherwise you should reject the request.', 'Handle the request according to the integrated change control processes described in your management plans. Then make a decision together with the appropriate change control body, whether the increased customer satisfaction will be worth the extra costs, work, risks etc.', 'option4', 1, '2019-02-04 02:28:33', '2019-02-04 02:28:33'),
(37, 1, 'A facilitator should...', '...be in full control of the discussion and its outcomes.', '...always take notes by herself.', '...avoid a flip chart parking lot.', '...give guidance as required without interfering.', 'option4', 1, '2019-02-04 02:29:20', '2019-02-04 02:29:20'),
(38, 1, 'As the project manager in a software project which is currently initiated, you want to assess high-level risks. What should you do?', 'Develop the project charter and a risk management plan to start identifying risks based on those and other documents.', 'Identify and analyze risk events using qualitative and quantitative techniques.', 'Develop contingency plans and fallback plans in case the original plan proves wrong.', 'Discuss the risks documented in your Risk register with the project key stakeholders.', 'option1', 1, '2019-02-04 02:30:35', '2019-02-04 02:30:35'),
(39, 1, 'What should managers consider before conducting a performance evaluation interview with a project team member? ', 'Which management fallacies can most easily be delegated to the worker?', 'How can discussion of the manager’s leadership style be avoided?', 'Has the employee been provided with sufficient instructions and work tools?', 'How can dispute related to unsatisfactory performance be avoided?', 'option3', 1, '2019-02-04 02:31:28', '2019-02-04 02:31:28'),
(40, 1, 'Which statement describes best handling of assumptions during the initiating processes?', 'It is the responsibility of the sales person in charge to identify all risks related to a customer project.', 'Managing and organizing assumptions means avoiding risks right from the start of the project.', 'Organizational, environmental and external assumptions should be addressed by the project charter.', 'Risks are a sign of uncertainty. Avoiding all uncertainties means that a project should have no risks at all.', 'option3', 1, '2019-02-04 02:32:15', '2019-02-04 02:32:15'),
(41, 2, '&lt;p&gt;One question only. Just to see. E assim vamos nós...&lt;/p&gt;', '&lt;p&gt;1&lt;/p&gt;', '&lt;p&gt;2&lt;/p&gt;', '&lt;p&gt;4&lt;/p&gt;', '&lt;p&gt;5&lt;/p&gt;', 'option2', 0, '2019-02-04 02:59:23', '2019-02-16 02:10:17'),
(42, 8, 'Calculate the result of 2 + 2?', '1', '2', '3', '4', 'option4', 1, '2019-02-09 02:34:57', '2019-02-09 02:34:57'),
(43, 8, 'Calculate the result of 4 + 4?', '2', '4', '6', '8', 'option4', 1, '2019-02-09 02:35:17', '2019-02-09 02:35:17'),
(44, 8, 'Calculate the result of 2 * 3?', '2', '4', '6', '8', 'option3', 1, '2019-02-09 02:35:45', '2019-02-09 02:35:45'),
(45, 8, 'Calculate the result of 1 + 10?', '10', '11', '110', '100', 'option2', 1, '2019-02-09 02:36:20', '2019-02-09 02:36:20'),
(46, 8, 'Calculate the result of 10 / 2?', '81', '20', '5', '12', 'option3', 1, '2019-02-09 02:36:45', '2019-02-09 02:36:45'),
(47, 8, 'Calculate the result of 81 / 9?', '7', '6', '9', '8', 'option3', 1, '2019-02-09 02:37:26', '2019-02-09 02:37:26'),
(48, 8, '&lt;p&gt;Calculate the result of &quot;11&quot; + &quot;11&quot;?&lt;/p&gt;', '1111', '22', '11', '0', 'option1', 1, '2019-02-09 02:38:08', '2019-02-13 03:00:21'),
(49, 8, 'Calculate the result of 2 / 2?', '1', '2', '3', '4', 'option1', 1, '2019-02-09 02:38:30', '2019-02-09 02:38:30'),
(50, 8, 'Calculate the result of 8 + 2?', '9', '10', '16', '4', 'option2', 1, '2019-02-09 02:39:19', '2019-02-09 02:39:19'),
(51, 8, 'Calculate the result of 3 * 3?', '9', '6', '1', '0', 'option1', 1, '2019-02-09 02:39:51', '2019-02-09 02:39:51'),
(52, 8, 'Calculate the result of 2 + 3 * 2?', '8', '10', '6', '7', 'option1', 1, '2019-02-09 02:41:17', '2019-02-09 02:41:17'),
(53, 8, 'Calculate the result of 20 / 10?', '10', '2', '5', '4', 'option2', 1, '2019-02-09 02:41:46', '2019-02-09 02:41:46'),
(54, 8, 'Calculate the result of 49 / 7?', '6', '7', '8', '9', 'option2', 1, '2019-02-09 02:42:35', '2019-02-09 02:42:35'),
(55, 8, 'Calculate the result of 1 + 2 + 3?', '4', '5', '6', '7', 'option3', 1, '2019-02-09 02:43:11', '2019-02-09 02:43:11'),
(56, 8, 'Calculate the result of (3!)?', '1', '3', '6', '9', 'option3', 1, '2019-02-09 02:44:29', '2019-02-09 02:44:29'),
(57, 8, '&lt;ol&gt;&lt;li&gt;Calculate the result of 3^2?&lt;/li&gt;&lt;/ol&gt;', '&lt;p&gt;1&lt;/p&gt;', '&lt;p&gt;5&lt;/p&gt;', '&lt;p&gt;6&lt;/p&gt;', '&lt;p&gt;9&lt;/p&gt;', 'option4', 1, '2019-02-09 02:45:21', '2019-02-16 02:29:00'),
(58, 8, 'Calculate the result of 2 + 48?', '46', '44', '50', '68', 'option3', 1, '2019-02-09 02:46:05', '2019-02-09 02:46:05'),
(59, 8, 'Calculate the result of 10 * 10?', '1', '10', '100', '1000', 'option3', 1, '2019-02-09 02:46:35', '2019-02-09 02:46:35'),
(60, 8, 'Calculate the result of 20 - 5?', '15', '25', '4', '30', 'option1', 1, '2019-02-09 02:47:25', '2019-02-09 02:47:25'),
(61, 8, 'Calculate the result of 8 + 8?', '64', '16', '14', '88', 'option2', 1, '2019-02-09 02:47:53', '2019-02-09 02:47:53'),
(62, 8, 'Calculate the result of 20 + 80?', '100', '60', '40', '110', 'option1', 1, '2019-02-12 23:07:34', '2019-02-12 23:13:40'),
(63, 6, '&lt;p&gt;Given:&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 2. class Feline { }&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 3. public class BarnCat2 extends Feline {&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 4. public static void main(String[] args) {&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 5. Feline ff = new Feline();&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 6. BarnCat2 b = new BarnCat2();&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 7. // insert code here&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 8. }&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 9. }&lt;/p&gt;&lt;p&gt;Which, inserted independently at line 7, compile?&lt;/p&gt;', '&lt;p&gt;if(b instanceof ff) System.out.print(&quot;1 &quot;);&lt;/p&gt;', '&lt;p&gt;if(b.instanceof(ff)) System.out.print(&quot;2 &quot;);&lt;/p&gt;', '&lt;p&gt;if(b instanceof Feline) System.out.print(&quot;3 &quot;);&lt;/p&gt;', '&lt;p&gt;if(b instanceOf Feline) System.out.print(&quot;4 &quot;);&lt;/p&gt;', 'option3', 1, '2019-02-13 04:12:16', '2019-02-13 04:13:51'),
(66, 9, '&lt;p&gt;Given:&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 2. class Feline { }&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 3. public class BarnCat2 extends Feline {&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 4. public static void main(String[] args) {&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 5. Feline ff = new Feline();&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 6. BarnCat2 b = new BarnCat2();&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 7. // insert code here&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 8. }&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 9. }&lt;/p&gt;&lt;p&gt;Which, inserted independently at line 7, compile?&lt;/p&gt;', '&lt;p&gt;if(b instanceof ff) System.out.print(&quot;1 &quot;);&lt;/p&gt;', '&lt;p&gt;if(b.instanceof(ff)) System.out.print(&quot;2 &quot;);&lt;/p&gt;', '&lt;p&gt;if(b instanceof Feline) System.out.print(&quot;3 &quot;);&lt;/p&gt;', '&lt;p&gt;if(b instanceOf Feline) System.out.print(&quot;4 &quot;);&lt;/p&gt;', 'option3', 1, '2019-02-13 04:33:32', '2019-02-13 04:33:32'),
(70, 11, '&lt;p&gt;Test de cadastro de questao&lt;/p&gt;', '&lt;p&gt;resposta 1&lt;/p&gt;', '&lt;p&gt;resposta 2 e correta&lt;/p&gt;', '&lt;p&gt;resposta 3&lt;/p&gt;', '&lt;p&gt;resposta 4&lt;/p&gt;', 'option2', 1, '2019-02-16 05:26:16', '2019-02-16 05:26:16'),
(71, 11, '&lt;p&gt;Another question to make sure&lt;/p&gt;&lt;p&gt;asdasdasd&lt;/p&gt;&lt;p&gt;&lt;i&gt;&lt;strong&gt;asdas&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;&lt;p&gt;asdas&lt;/p&gt;', '&lt;p&gt;and another answer&lt;/p&gt;', '&lt;p&gt;and another answer one more time&lt;/p&gt;', '&lt;p&gt;and another answer and the correct answer&lt;/p&gt;', '&lt;p&gt;ok&lt;/p&gt;', 'option3', 0, '2019-02-16 05:27:41', '2019-02-16 05:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tests`
--

DROP TABLE IF EXISTS `tb_tests`;
CREATE TABLE IF NOT EXISTS `tb_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCategory` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` longtext,
  `numQuestions` int(11) NOT NULL DEFAULT '10',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_tests`
--

INSERT INTO `tb_tests` (`id`, `idCategory`, `name`, `description`, `numQuestions`, `status`, `createdDate`, `modifiedDate`) VALUES
(1, 1, 'PMP Project Management', 'Test your knowledge about PMP and get better score', 10, 1, '2019-01-30 22:41:23', '2019-02-16 02:29:25'),
(2, 2, 'Microsoft Certified Of Something', 'Microsoft Certified Of Something', 15, 0, '2019-01-31 00:56:21', '2019-02-09 16:20:04'),
(6, 2, 'OCP Java SE 6 Programmer', 'Practice Exams', 10, 1, '2019-02-04 00:21:29', '2019-02-04 00:21:29'),
(8, 3, 'Basic Math', 'Basic Mathematics', 10, 1, '2019-02-09 02:34:09', '2019-02-16 02:28:15'),
(9, 2, 'Test', 'Anything', 10, 0, '2019-02-12 22:57:37', '2019-02-13 04:54:21'),
(10, 2, 'Just to try', 'It will be inactivated', 10, 0, '2019-02-16 05:24:18', '2019-02-16 05:28:55'),
(11, 3, 'Another ', 'Now is Math time!', 10, 0, '2019-02-16 05:24:42', '2019-02-16 05:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tests_answers`
--

DROP TABLE IF EXISTS `tb_tests_answers`;
CREATE TABLE IF NOT EXISTS `tb_tests_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idTest` int(11) NOT NULL,
  `idTestResult` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `optionChosen` varchar(10) DEFAULT NULL,
  `correctOption` varchar(10) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_tests_answers`
--

INSERT INTO `tb_tests_answers` (`id`, `idUser`, `idTest`, `idTestResult`, `idQuestion`, `optionChosen`, `correctOption`, `createdDate`) VALUES
(99, 8, 1, 36, 31, 'option1', 'option3', '2019-02-09 02:24:49'),
(100, 8, 1, 36, 1, 'option1', 'option3', '2019-02-09 02:24:52'),
(101, 8, 1, 36, 25, 'option1', 'option4', '2019-02-09 02:24:55'),
(102, 8, 1, 36, 35, 'option1', 'option2', '2019-02-09 02:24:58'),
(103, 8, 1, 36, 38, 'option1', 'option1', '2019-02-09 02:25:00'),
(104, 8, 1, 36, 3, 'option1', 'option2', '2019-02-09 02:25:03'),
(105, 8, 1, 36, 30, 'option1', 'option4', '2019-02-09 02:25:07'),
(106, 8, 1, 36, 26, 'option1', 'option3', '2019-02-09 02:25:09'),
(107, 8, 1, 36, 39, 'option1', 'option3', '2019-02-09 02:25:11'),
(108, 8, 1, 36, 2, 'option1', 'option1', '2019-02-09 02:25:14'),
(110, 8, 8, 38, 49, 'option1', 'option1', '2019-02-09 02:53:05'),
(111, 8, 8, 38, 44, 'option3', 'option3', '2019-02-09 02:53:09'),
(112, 8, 8, 38, 42, 'option4', 'option4', '2019-02-09 02:53:11'),
(113, 8, 8, 38, 60, 'option1', 'option1', '2019-02-09 02:53:14'),
(114, 8, 8, 38, 47, 'option3', 'option3', '2019-02-09 02:53:17'),
(115, 8, 8, 38, 48, 'option1', 'option1', '2019-02-09 02:53:20'),
(116, 8, 8, 38, 61, 'option2', 'option2', '2019-02-09 02:53:24'),
(117, 8, 8, 38, 59, 'option3', 'option3', '2019-02-09 02:53:28'),
(118, 8, 8, 38, 55, 'option3', 'option3', '2019-02-09 02:53:31'),
(119, 8, 8, 38, 56, 'option3', 'option3', '2019-02-09 02:53:34'),
(120, 8, 8, 39, 44, 'option3', 'option3', '2019-02-09 03:03:58'),
(121, 8, 8, 39, 46, 'option3', 'option3', '2019-02-09 03:04:02'),
(122, 8, 8, 39, 45, 'option2', 'option2', '2019-02-09 03:04:39'),
(123, 8, 8, 39, 55, 'option3', 'option3', '2019-02-09 03:07:26'),
(124, 8, 8, 39, 61, 'option2', 'option2', '2019-02-09 03:08:17'),
(125, 8, 8, 39, 54, 'option2', 'option2', '2019-02-09 03:08:36'),
(126, 8, 8, 39, 43, 'option4', 'option4', '2019-02-09 03:09:21'),
(127, 8, 8, 39, 47, 'option3', 'option3', '2019-02-09 03:09:40'),
(128, 8, 8, 39, 59, 'option3', 'option3', '2019-02-09 03:09:53'),
(129, 8, 8, 39, 42, 'option4', 'option4', '2019-02-09 03:10:03'),
(132, 8, 8, 41, 50, 'option2', 'option2', '2019-02-09 03:29:33'),
(133, 8, 8, 41, 44, 'option3', 'option3', '2019-02-09 03:29:37'),
(134, 8, 8, 41, 56, 'option3', 'option3', '2019-02-09 03:29:43'),
(135, 8, 8, 41, 45, 'option2', 'option2', '2019-02-09 03:29:48'),
(136, 8, 8, 41, 46, 'option3', 'option3', '2019-02-09 03:29:52'),
(137, 8, 8, 41, 49, 'option1', 'option1', '2019-02-09 03:29:55'),
(138, 8, 8, 41, 48, 'option1', 'option1', '2019-02-09 03:29:58'),
(139, 8, 8, 41, 59, 'option3', 'option3', '2019-02-09 03:30:03'),
(140, 8, 8, 41, 57, 'option4', 'option4', '2019-02-09 03:30:06'),
(141, 8, 8, 41, 61, 'option2', 'option2', '2019-02-09 03:30:11'),
(142, 8, 8, 42, 52, 'option1', 'option1', '2019-02-09 03:35:32'),
(143, 8, 8, 42, 49, 'option1', 'option1', '2019-02-09 03:35:40'),
(144, 8, 8, 42, 48, 'option1', 'option1', '2019-02-09 03:35:42'),
(145, 8, 8, 42, 51, 'option1', 'option1', '2019-02-09 03:35:45'),
(146, 8, 8, 42, 53, 'option2', 'option2', '2019-02-09 03:35:48'),
(147, 8, 8, 42, 42, 'option4', 'option4', '2019-02-09 03:35:52'),
(148, 8, 8, 42, 43, 'option4', 'option4', '2019-02-09 03:35:56'),
(149, 8, 8, 42, 45, 'option2', 'option2', '2019-02-09 03:35:59'),
(150, 8, 8, 42, 59, 'option3', 'option3', '2019-02-09 03:36:01'),
(151, 8, 8, 42, 56, 'option3', 'option3', '2019-02-09 03:36:04'),
(152, 8, 8, 43, 42, 'option2', 'option4', '2019-02-09 03:36:18'),
(153, 8, 8, 43, 58, 'option3', 'option3', '2019-02-09 03:36:21'),
(154, 8, 8, 43, 50, 'option2', 'option2', '2019-02-09 03:36:24'),
(155, 8, 8, 43, 43, 'option4', 'option4', '2019-02-09 03:36:26'),
(156, 8, 8, 43, 48, 'option2', 'option1', '2019-02-09 03:36:29'),
(157, 8, 8, 43, 49, 'option1', 'option1', '2019-02-09 03:36:31'),
(158, 8, 8, 43, 61, 'option2', 'option2', '2019-02-09 03:36:34'),
(159, 8, 8, 43, 56, 'option3', 'option3', '2019-02-09 03:36:37'),
(160, 8, 8, 43, 57, 'option4', 'option4', '2019-02-09 03:36:39'),
(161, 8, 8, 43, 60, 'option1', 'option1', '2019-02-09 03:36:43'),
(162, 8, 8, 44, 52, 'option1', 'option1', '2019-02-09 03:36:56'),
(163, 8, 8, 44, 60, 'option1', 'option1', '2019-02-09 03:37:00'),
(164, 8, 8, 44, 55, 'option3', 'option3', '2019-02-09 03:37:03'),
(165, 8, 8, 44, 48, 'option1', 'option1', '2019-02-09 03:37:05'),
(166, 8, 8, 44, 49, 'option1', 'option1', '2019-02-09 03:37:07'),
(167, 8, 8, 44, 47, 'option2', 'option3', '2019-02-09 03:37:10'),
(168, 8, 8, 44, 53, 'option1', 'option2', '2019-02-09 03:37:13'),
(169, 8, 8, 44, 50, 'option4', 'option2', '2019-02-09 03:37:16'),
(170, 8, 8, 44, 46, 'option3', 'option3', '2019-02-09 03:37:20'),
(171, 8, 8, 44, 56, 'option1', 'option3', '2019-02-09 03:37:23'),
(172, 8, 8, 45, 57, 'option4', 'option4', '2019-02-09 03:53:53'),
(173, 8, 8, 45, 42, 'option4', 'option4', '2019-02-09 03:53:57'),
(174, 8, 8, 45, 46, 'option3', 'option3', '2019-02-09 03:54:00'),
(175, 8, 8, 45, 51, 'option1', 'option1', '2019-02-09 03:54:02'),
(176, 8, 8, 45, 44, 'option3', 'option3', '2019-02-09 03:54:05'),
(177, 8, 8, 45, 53, 'option1', 'option2', '2019-02-09 03:54:07'),
(178, 8, 8, 45, 59, 'option2', 'option3', '2019-02-09 03:54:10'),
(179, 8, 8, 45, 50, 'option2', 'option2', '2019-02-09 03:54:14'),
(180, 8, 8, 45, 48, 'option1', 'option1', '2019-02-09 03:54:17'),
(181, 8, 8, 45, 55, 'option3', 'option3', '2019-02-09 03:54:21'),
(182, 8, 8, 46, 60, 'option1', 'option1', '2019-02-09 04:02:20'),
(183, 8, 8, 46, 49, 'option1', 'option1', '2019-02-09 04:02:23'),
(184, 8, 8, 46, 52, 'option2', 'option1', '2019-02-09 04:02:25'),
(185, 8, 8, 46, 54, 'option1', 'option2', '2019-02-09 04:02:26'),
(186, 8, 8, 46, 61, 'option3', 'option2', '2019-02-09 04:02:28'),
(187, 8, 8, 46, 59, 'option2', 'option3', '2019-02-09 04:02:31'),
(188, 8, 8, 46, 56, 'option2', 'option3', '2019-02-09 04:02:33'),
(189, 8, 8, 46, 51, 'option2', 'option1', '2019-02-09 04:02:35'),
(190, 8, 8, 46, 55, 'option1', 'option3', '2019-02-09 04:02:37'),
(191, 8, 8, 46, 57, NULL, 'option4', '2019-02-09 04:02:39'),
(194, 12, 1, 48, 35, 'option2', 'option2', '2019-02-12 17:55:28'),
(195, 12, 1, 48, 24, 'option1', 'option4', '2019-02-12 17:55:32'),
(196, 12, 1, 48, 31, 'option4', 'option3', '2019-02-12 17:55:35'),
(197, 12, 1, 48, 32, 'option2', 'option2', '2019-02-12 17:55:36'),
(198, 12, 1, 48, 34, 'option1', 'option1', '2019-02-12 17:55:38'),
(199, 12, 1, 48, 3, 'option1', 'option2', '2019-02-12 17:55:40'),
(200, 12, 1, 48, 36, 'option2', 'option4', '2019-02-12 17:55:42'),
(201, 12, 1, 48, 30, 'option4', 'option4', '2019-02-12 17:55:44'),
(202, 12, 1, 48, 29, 'option4', 'option1', '2019-02-12 17:55:46'),
(203, 12, 1, 48, 27, NULL, 'option2', '2019-02-12 17:55:48'),
(204, 12, 8, 49, 43, 'option1', 'option4', '2019-02-12 18:00:03'),
(205, 12, 8, 49, 61, 'option2', 'option2', '2019-02-12 18:00:06'),
(206, 12, 8, 49, 57, 'option2', 'option4', '2019-02-12 18:00:08'),
(207, 12, 8, 49, 42, 'option4', 'option4', '2019-02-12 18:00:10'),
(208, 12, 8, 49, 45, 'option2', 'option2', '2019-02-12 18:00:12'),
(209, 12, 8, 49, 47, 'option3', 'option3', '2019-02-12 18:00:15'),
(210, 12, 8, 49, 59, 'option1', 'option3', '2019-02-12 18:00:18'),
(211, 12, 8, 49, 51, 'option1', 'option1', '2019-02-12 18:00:21'),
(212, 12, 8, 49, 60, 'option1', 'option1', '2019-02-12 18:00:23'),
(213, 12, 8, 49, 54, NULL, 'option2', '2019-02-12 18:00:26'),
(214, 12, 6, 50, 13, 'option1', 'option3', '2019-02-12 18:05:03'),
(215, 12, 6, 50, 9, 'option2', 'option4', '2019-02-12 18:05:06'),
(216, 12, 6, 50, 6, 'option3', 'option3', '2019-02-12 18:05:08'),
(217, 12, 6, 50, 10, 'option3', 'option3', '2019-02-12 18:05:11'),
(218, 12, 6, 50, 15, 'option2', 'option1', '2019-02-12 18:05:13'),
(219, 12, 6, 50, 21, 'option1', 'option3', '2019-02-12 18:05:14'),
(220, 12, 6, 50, 12, 'option1', 'option4', '2019-02-12 18:05:16'),
(221, 12, 6, 50, 16, 'option1', 'option1', '2019-02-12 18:05:19'),
(222, 12, 6, 50, 22, 'option1', 'option1', '2019-02-12 18:05:21'),
(223, 12, 6, 50, 5, NULL, 'option1', '2019-02-12 18:05:23'),
(237, 11, 8, 52, 52, 'option1', 'option1', '2019-02-12 18:19:56'),
(238, 11, 8, 52, 48, 'option1', 'option1', '2019-02-12 18:20:02'),
(239, 11, 8, 52, 49, 'option1', 'option1', '2019-02-12 18:20:05'),
(240, 11, 8, 52, 51, 'option1', 'option1', '2019-02-12 18:20:07'),
(241, 11, 8, 52, 53, 'option2', 'option2', '2019-02-12 18:20:09'),
(242, 11, 8, 52, 59, 'option3', 'option3', '2019-02-12 18:20:12'),
(243, 11, 8, 52, 60, 'option1', 'option1', '2019-02-12 18:20:16'),
(244, 11, 8, 52, 47, 'option3', 'option3', '2019-02-12 18:20:19'),
(245, 11, 8, 52, 56, 'option3', 'option3', '2019-02-12 18:20:21'),
(246, 11, 8, 52, 55, NULL, 'option3', '2019-02-12 18:20:24'),
(247, 11, 8, 53, 43, 'option4', 'option4', '2019-02-12 18:23:16'),
(248, 11, 8, 53, 54, 'option2', 'option2', '2019-02-12 18:23:20'),
(249, 11, 8, 53, 59, 'option3', 'option3', '2019-02-12 18:23:23'),
(250, 11, 8, 53, 47, 'option3', 'option3', '2019-02-12 18:23:25'),
(251, 11, 8, 53, 61, 'option2', 'option2', '2019-02-12 18:23:27'),
(252, 11, 8, 53, 49, 'option1', 'option1', '2019-02-12 18:23:30'),
(253, 11, 8, 53, 45, 'option2', 'option2', '2019-02-12 18:23:33'),
(254, 11, 8, 53, 51, 'option1', 'option1', '2019-02-12 18:23:35'),
(255, 11, 8, 53, 48, 'option1', 'option1', '2019-02-12 18:23:37'),
(256, 11, 8, 53, 58, 'option3', 'option3', '2019-02-12 18:23:40'),
(257, 11, 6, 54, 10, 'option2', 'option3', '2019-02-12 18:25:54'),
(258, 11, 6, 54, 16, 'option3', 'option1', '2019-02-12 18:25:56'),
(259, 11, 6, 54, 17, 'option2', 'option4', '2019-02-12 18:25:58'),
(260, 11, 6, 54, 19, 'option4', 'option1', '2019-02-12 18:26:01'),
(261, 11, 6, 54, 21, 'option4', 'option3', '2019-02-12 18:26:02'),
(262, 11, 6, 54, 7, 'option2', 'option2', '2019-02-12 18:26:04'),
(263, 11, 6, 54, 22, 'option1', 'option1', '2019-02-12 18:26:06'),
(264, 11, 6, 54, 6, 'option1', 'option3', '2019-02-12 18:26:08'),
(265, 11, 6, 54, 13, 'option2', 'option3', '2019-02-12 18:26:11'),
(266, 11, 6, 54, 20, 'option1', 'option4', '2019-02-12 18:26:14'),
(267, 11, 8, 55, 53, 'option2', 'option2', '2019-02-12 20:32:13'),
(268, 11, 8, 55, 43, 'option4', 'option4', '2019-02-12 20:34:37'),
(269, 11, 8, 55, 42, 'option4', 'option4', '2019-02-12 20:34:42'),
(270, 11, 8, 55, 45, 'option2', 'option2', '2019-02-12 20:35:03'),
(271, 11, 8, 55, 56, 'option3', 'option3', '2019-02-12 20:35:27'),
(272, 12, 6, 56, 5, 'option1', 'option1', '2019-02-12 20:35:38'),
(273, 11, 8, 55, 55, 'option3', 'option3', '2019-02-12 20:35:53'),
(274, 11, 8, 55, 48, 'option1', 'option1', '2019-02-12 20:35:56'),
(275, 11, 8, 55, 50, 'option3', 'option2', '2019-02-12 20:35:58'),
(276, 11, 8, 55, 61, 'option4', 'option2', '2019-02-12 20:36:00'),
(277, 11, 8, 55, 58, 'option4', 'option3', '2019-02-12 20:36:02'),
(278, 12, 6, 56, 13, 'option4', 'option3', '2019-02-12 20:36:21'),
(279, 12, 6, 56, 22, 'option3', 'option1', '2019-02-12 20:36:55'),
(280, 12, 6, 56, 10, 'option1', 'option3', '2019-02-12 20:37:17'),
(281, 12, 6, 56, 14, 'option1', 'option4', '2019-02-12 20:37:27'),
(282, 12, 6, 56, 18, 'option4', 'option4', '2019-02-12 20:37:29'),
(283, 12, 6, 56, 15, 'option4', 'option1', '2019-02-12 20:37:32'),
(284, 12, 6, 56, 17, 'option3', 'option4', '2019-02-12 20:37:34'),
(285, 12, 6, 56, 11, 'option1', 'option3', '2019-02-12 20:37:36'),
(286, 12, 6, 56, 23, 'option3', 'option1', '2019-02-12 20:37:38'),
(287, 12, 1, 57, 25, 'option2', 'option4', '2019-02-12 20:41:54'),
(288, 12, 1, 57, 27, 'option3', 'option2', '2019-02-12 20:42:06'),
(289, 12, 1, 57, 35, 'option3', 'option2', '2019-02-12 20:42:08'),
(290, 12, 1, 57, 29, 'option2', 'option1', '2019-02-12 20:42:10'),
(291, 12, 1, 57, 28, 'option2', 'option4', '2019-02-12 20:42:11'),
(292, 12, 1, 57, 30, 'option1', 'option4', '2019-02-12 20:43:31'),
(293, 12, 1, 57, 31, 'option4', 'option3', '2019-02-12 20:43:33'),
(294, 12, 1, 57, 24, 'option4', 'option4', '2019-02-12 20:43:34'),
(295, 12, 1, 57, 3, 'option4', 'option2', '2019-02-12 20:43:36'),
(296, 12, 1, 57, 26, 'option4', 'option3', '2019-02-12 20:43:38'),
(303, 12, 8, 64, 51, 'option1', 'option1', '2019-02-12 20:57:30'),
(304, 12, 8, 64, 43, 'option4', 'option4', '2019-02-12 20:57:44'),
(305, 12, 8, 64, 56, 'option3', 'option3', '2019-02-12 20:57:47'),
(306, 12, 8, 64, 44, 'option3', 'option3', '2019-02-12 20:57:57'),
(307, 12, 8, 64, 55, 'option3', 'option3', '2019-02-12 20:57:59'),
(308, 12, 8, 64, 52, 'option2', 'option1', '2019-02-12 20:58:02'),
(309, 12, 8, 64, 60, 'option1', 'option1', '2019-02-12 20:58:05'),
(310, 12, 8, 64, 48, 'option3', 'option1', '2019-02-12 20:58:07'),
(311, 12, 8, 64, 46, 'option3', 'option3', '2019-02-12 20:58:09'),
(312, 12, 8, 64, 57, 'option3', 'option4', '2019-02-12 20:58:11'),
(313, 11, 1, 65, 33, 'option2', 'option2', '2019-02-12 20:58:50'),
(314, 11, 1, 65, 26, 'option3', 'option3', '2019-02-12 20:59:02'),
(315, 11, 1, 65, 34, 'option1', 'option1', '2019-02-12 20:59:03'),
(316, 11, 1, 65, 28, 'option4', 'option4', '2019-02-12 20:59:05'),
(317, 11, 1, 65, 29, 'option4', 'option1', '2019-02-12 20:59:07'),
(318, 11, 1, 65, 40, 'option4', 'option3', '2019-02-12 20:59:16'),
(319, 11, 1, 65, 37, 'option1', 'option4', '2019-02-12 20:59:18'),
(320, 11, 1, 65, 3, 'option2', 'option2', '2019-02-12 20:59:20'),
(321, 11, 1, 65, 32, 'option3', 'option2', '2019-02-12 20:59:21'),
(322, 11, 1, 65, 1, 'option4', 'option3', '2019-02-12 20:59:23'),
(327, 11, 1, 69, 39, 'option2', 'option3', '2019-02-12 22:52:23'),
(328, 11, 1, 69, 1, 'option1', 'option3', '2019-02-12 22:52:26'),
(329, 11, 1, 69, 35, 'option3', 'option2', '2019-02-12 22:52:29'),
(330, 11, 1, 69, 30, 'option2', 'option4', '2019-02-12 22:52:30'),
(331, 11, 1, 69, 24, 'option1', 'option4', '2019-02-12 22:52:32'),
(332, 11, 1, 69, 40, 'option2', 'option3', '2019-02-12 22:52:34'),
(333, 11, 1, 69, 37, 'option2', 'option4', '2019-02-12 22:52:36'),
(334, 11, 1, 69, 38, 'option3', 'option1', '2019-02-12 22:52:38'),
(335, 11, 1, 69, 28, 'option4', 'option4', '2019-02-12 22:52:40'),
(336, 11, 1, 69, 33, 'option3', 'option2', '2019-02-12 22:52:41'),
(337, 8, 6, 70, 5, 'option2', 'option1', '2019-02-13 03:08:57'),
(338, 8, 6, 70, 21, 'option1', 'option3', '2019-02-13 03:09:02'),
(339, 8, 6, 70, 9, 'option2', 'option4', '2019-02-13 03:09:05'),
(340, 8, 6, 70, 11, 'option2', 'option3', '2019-02-13 03:09:07'),
(341, 8, 6, 70, 23, 'option4', 'option1', '2019-02-13 03:09:10'),
(342, 8, 6, 70, 15, 'option2', 'option1', '2019-02-13 03:09:13'),
(343, 8, 6, 70, 8, 'option1', 'option2', '2019-02-13 03:09:15'),
(344, 8, 6, 70, 20, 'option2', 'option4', '2019-02-13 03:09:18'),
(345, 8, 6, 70, 19, 'option3', 'option1', '2019-02-13 03:09:27'),
(346, 8, 6, 70, 4, 'option4', 'option2', '2019-02-13 03:09:31'),
(347, 12, 6, 71, 12, 'option1', 'option4', '2019-02-13 04:14:37'),
(348, 12, 6, 71, 5, 'option3', 'option1', '2019-02-13 04:14:41'),
(349, 12, 6, 71, 10, 'option1', 'option3', '2019-02-13 04:14:43'),
(350, 12, 6, 71, 21, 'option1', 'option3', '2019-02-13 04:14:47'),
(351, 12, 6, 71, 20, 'option1', 'option4', '2019-02-13 04:14:50'),
(352, 12, 6, 71, 19, 'option3', 'option1', '2019-02-13 04:14:55'),
(353, 12, 6, 71, 18, 'option2', 'option4', '2019-02-13 04:14:58'),
(354, 12, 6, 71, 4, 'option1', 'option2', '2019-02-13 04:15:01'),
(355, 12, 6, 71, 14, 'option2', 'option4', '2019-02-13 04:15:06'),
(356, 12, 6, 71, 11, 'option1', 'option3', '2019-02-13 04:15:09'),
(357, 12, 6, 72, 12, 'option3', 'option4', '2019-02-13 04:15:20'),
(358, 12, 6, 72, 21, 'option2', 'option3', '2019-02-13 04:15:23'),
(359, 12, 6, 72, 15, 'option1', 'option1', '2019-02-13 04:15:26'),
(360, 12, 6, 72, 5, 'option2', 'option1', '2019-02-13 04:15:29'),
(361, 12, 6, 72, 16, 'option2', 'option1', '2019-02-13 04:15:32'),
(362, 12, 6, 72, 13, 'option4', 'option3', '2019-02-13 04:15:35'),
(363, 12, 6, 72, 18, 'option4', 'option4', '2019-02-13 04:15:39'),
(364, 12, 6, 72, 4, 'option1', 'option2', '2019-02-13 04:15:43'),
(365, 12, 6, 72, 22, 'option1', 'option1', '2019-02-13 04:15:46'),
(366, 12, 6, 72, 10, 'option4', 'option3', '2019-02-13 04:15:53'),
(367, 12, 6, 73, 23, 'option2', 'option1', '2019-02-13 04:16:14'),
(368, 12, 6, 73, 14, NULL, 'option4', '2019-02-13 04:16:17'),
(369, 12, 6, 73, 13, 'option4', 'option3', '2019-02-13 04:16:19'),
(370, 12, 6, 73, 4, NULL, 'option2', '2019-02-13 04:16:22'),
(371, 12, 6, 73, 18, NULL, 'option4', '2019-02-13 04:16:23'),
(372, 12, 6, 73, 19, 'option4', 'option1', '2019-02-13 04:16:30'),
(373, 12, 6, 73, 15, 'option2', 'option1', '2019-02-13 04:16:33'),
(374, 12, 6, 73, 7, 'option2', 'option2', '2019-02-13 04:16:36'),
(375, 12, 6, 73, 63, 'option1', 'option3', '2019-02-13 04:16:38'),
(376, 12, 6, 73, 6, 'option2', 'option3', '2019-02-13 04:16:41'),
(394, 16, 8, 76, 45, 'option2', 'option2', '2019-02-16 03:43:29'),
(395, 16, 8, 76, 61, 'option2', 'option2', '2019-02-16 03:43:32'),
(396, 16, 8, 76, 60, 'option1', 'option1', '2019-02-16 03:43:35'),
(397, 16, 8, 76, 42, 'option4', 'option4', '2019-02-16 03:43:37'),
(398, 16, 8, 76, 59, 'option3', 'option3', '2019-02-16 03:43:39'),
(399, 16, 8, 76, 51, 'option1', 'option1', '2019-02-16 03:43:41'),
(400, 16, 8, 76, 54, 'option2', 'option2', '2019-02-16 03:43:43'),
(401, 16, 8, 76, 62, 'option1', 'option1', '2019-02-16 03:43:46'),
(402, 16, 8, 76, 44, 'option3', 'option3', '2019-02-16 03:43:49'),
(403, 16, 8, 76, 50, 'option2', 'option2', '2019-02-16 03:43:52'),
(405, 16, 1, 81, 37, 'option4', 'option4', '2019-02-16 05:09:09'),
(406, 16, 1, 81, 24, 'option3', 'option4', '2019-02-16 05:09:22'),
(407, 16, 1, 81, 35, 'option4', 'option2', '2019-02-16 05:09:34'),
(408, 16, 1, 81, 38, 'option3', 'option1', '2019-02-16 05:10:05'),
(409, 16, 1, 81, 31, 'option3', 'option3', '2019-02-16 05:10:29'),
(410, 16, 1, 81, 30, 'option4', 'option4', '2019-02-16 05:11:09'),
(411, 16, 1, 81, 29, 'option1', 'option1', '2019-02-16 05:11:20'),
(412, 16, 1, 81, 2, 'option4', 'option1', '2019-02-16 05:11:40'),
(413, 16, 1, 81, 36, 'option4', 'option4', '2019-02-16 05:12:01'),
(414, 16, 1, 81, 3, 'option1', 'option2', '2019-02-16 05:12:40'),
(415, 16, 8, 82, 56, 'option3', 'option3', '2019-02-16 05:21:21'),
(416, 16, 8, 82, 50, 'option2', 'option2', '2019-02-16 05:21:33'),
(417, 16, 8, 82, 42, 'option4', 'option4', '2019-02-16 05:21:36'),
(418, 16, 8, 82, 61, 'option2', 'option2', '2019-02-16 05:21:38'),
(419, 16, 8, 82, 53, 'option2', 'option2', '2019-02-16 05:21:41'),
(420, 16, 8, 82, 49, 'option1', 'option1', '2019-02-16 05:21:44'),
(421, 16, 8, 82, 43, 'option4', 'option4', '2019-02-16 05:21:48'),
(422, 16, 8, 82, 44, 'option3', 'option3', '2019-02-16 05:21:56'),
(423, 16, 8, 82, 47, 'option3', 'option3', '2019-02-16 05:22:00'),
(424, 16, 8, 82, 59, 'option3', 'option3', '2019-02-16 05:22:03'),
(425, 8, 8, 83, 46, 'option3', 'option3', '2019-02-16 06:53:30'),
(426, 8, 8, 83, 43, 'option4', 'option4', '2019-02-16 06:53:36'),
(427, 8, 8, 83, 44, 'option3', 'option3', '2019-02-16 06:53:38'),
(428, 8, 8, 83, 54, 'option2', 'option2', '2019-02-16 06:53:41'),
(429, 8, 8, 83, 61, 'option2', 'option2', '2019-02-16 06:53:44'),
(430, 8, 8, 83, 55, 'option3', 'option3', '2019-02-16 06:53:46'),
(431, 8, 8, 83, 47, 'option3', 'option3', '2019-02-16 06:53:50'),
(432, 8, 8, 83, 49, 'option1', 'option1', '2019-02-16 06:53:54'),
(433, 8, 8, 83, 60, 'option1', 'option1', '2019-02-16 06:53:56'),
(434, 8, 8, 83, 57, 'option4', 'option4', '2019-02-16 06:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tests_results`
--

DROP TABLE IF EXISTS `tb_tests_results`;
CREATE TABLE IF NOT EXISTS `tb_tests_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idTest` int(11) NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `score` float NOT NULL DEFAULT '0',
  `passed` tinyint(1) NOT NULL DEFAULT '0',
  `numQuestionsAnswered` int(11) NOT NULL DEFAULT '0',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finishedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_tests_results`
--

INSERT INTO `tb_tests_results` (`id`, `idUser`, `idTest`, `finished`, `score`, `passed`, `numQuestionsAnswered`, `createdDate`, `modifiedDate`, `finishedDate`) VALUES
(36, 8, 1, 1, 2, 0, 10, '2019-02-09 02:24:49', '2019-02-09 02:25:17', '2019-02-09 02:25:17'),
(38, 8, 8, 1, 10, 1, 10, '2019-02-09 02:53:05', '2019-02-09 02:53:36', '2019-02-09 02:53:36'),
(39, 8, 8, 1, 10, 1, 10, '2019-02-09 03:03:58', '2019-02-09 03:10:10', '2019-02-09 03:10:10'),
(41, 8, 8, 1, 10, 1, 10, '2019-02-09 03:29:33', '2019-02-09 03:30:14', '2019-02-09 03:30:14'),
(42, 8, 8, 1, 10, 1, 10, '2019-02-09 03:35:32', '2019-02-09 03:36:07', '2019-02-09 03:36:07'),
(43, 8, 8, 1, 8, 1, 10, '2019-02-09 03:36:18', '2019-02-09 03:36:46', '2019-02-09 03:36:46'),
(44, 8, 8, 1, 6, 0, 10, '2019-02-09 03:36:56', '2019-02-09 03:37:26', '2019-02-09 03:37:26'),
(45, 8, 8, 1, 8, 1, 10, '2019-02-09 03:53:53', '2019-02-09 03:56:05', '2019-02-09 03:56:05'),
(46, 8, 8, 1, 2, 0, 10, '2019-02-09 04:02:20', '2019-02-09 04:02:39', '2019-02-09 04:02:39'),
(48, 12, 1, 1, 4, 0, 10, '2019-02-12 17:55:27', '2019-02-12 17:55:48', '2019-02-12 17:55:48'),
(49, 12, 8, 1, 6, 0, 10, '2019-02-12 18:00:03', '2019-02-12 18:00:26', '2019-02-12 18:00:26'),
(50, 12, 6, 1, 4, 0, 10, '2019-02-12 18:05:03', '2019-02-12 18:05:23', '2019-02-12 18:05:23'),
(52, 11, 8, 1, 9, 1, 10, '2019-02-12 18:19:56', '2019-02-12 18:20:24', '2019-02-12 18:20:24'),
(53, 11, 8, 1, 10, 1, 10, '2019-02-12 18:23:16', '2019-02-12 18:23:43', '2019-02-12 18:23:43'),
(54, 11, 6, 1, 2, 0, 10, '2019-02-12 18:25:54', '2019-02-12 18:26:16', '2019-02-12 18:26:16'),
(55, 11, 8, 1, 7, 0, 10, '2019-02-12 20:32:13', '2019-02-12 20:36:04', '2019-02-12 20:36:04'),
(56, 12, 6, 1, 2, 0, 10, '2019-02-12 20:35:38', '2019-02-12 20:37:39', '2019-02-12 20:37:39'),
(57, 12, 1, 1, 1, 0, 10, '2019-02-12 20:41:54', '2019-02-12 20:43:39', '2019-02-12 20:43:39'),
(64, 12, 8, 1, 7, 0, 10, '2019-02-12 20:57:30', '2019-02-12 20:58:14', '2019-02-12 20:58:14'),
(65, 11, 1, 1, 5, 0, 10, '2019-02-12 20:58:50', '2019-02-12 20:59:25', '2019-02-12 20:59:25'),
(69, 11, 1, 1, 1, 0, 10, '2019-02-12 22:52:23', '2019-02-12 22:52:43', '2019-02-12 22:52:43'),
(70, 8, 6, 1, 0, 0, 10, '2019-02-13 03:08:57', '2019-02-13 03:09:33', '2019-02-13 03:09:33'),
(71, 12, 6, 1, 0, 0, 10, '2019-02-13 04:14:37', '2019-02-13 04:15:13', '2019-02-13 04:15:13'),
(72, 12, 6, 1, 3, 0, 10, '2019-02-13 04:15:20', '2019-02-13 04:15:55', '2019-02-13 04:15:55'),
(73, 12, 6, 1, 1, 0, 10, '2019-02-13 04:16:14', '2019-02-13 04:16:44', '2019-02-13 04:16:44'),
(76, 16, 8, 1, 10, 1, 10, '2019-02-16 03:43:29', '2019-02-16 03:43:55', '2019-02-16 03:43:55'),
(81, 16, 1, 1, 5, 0, 10, '2019-02-16 05:09:09', '2019-02-16 05:12:54', '2019-02-16 05:12:54'),
(82, 16, 8, 1, 10, 1, 10, '2019-02-16 05:21:21', '2019-02-16 05:22:06', '2019-02-16 05:22:06'),
(83, 8, 8, 1, 10, 1, 10, '2019-02-16 06:53:30', '2019-02-16 06:54:02', '2019-02-16 06:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `firstName`, `lastName`, `email`, `password`, `phone`, `address`, `status`, `admin`, `createdDate`, `modifiedDate`, `lastLogin`) VALUES
(8, 'Giselle', 'Tavares', 'gitavares@gmail.com', '$2y$10$zZ/4WGmQ/iAEEzdz8chf1e3wbXQhuYlQrA148X.JTz6CdM09NAcUq', '1111111111', '111 Davisville', 1, 0, '2019-01-23 02:59:48', '2019-01-23 02:59:48', '2019-01-23 02:59:48'),
(9, 'Peri', 'Reis', 'peri_reis@hotmail.com', '$2y$10$RxSus4cVdGvPrGlfF9hdOeP1I/ybt0v5cE6NuCebJIrhlLMzcL48O', '1111111111', '111 Davisville', 1, 0, '2019-01-23 03:54:07', '2019-01-23 03:54:07', '2019-01-23 03:54:07'),
(10, 'Admin', 'Admin', 'admin@admin.com', '$2y$10$fW3zxenAeKOui/Y0tk3nhuLAq/EH6F.FA94/q4P0WjkPSC8i1x70C', '9999999999', '111 Davisville', 1, 1, '2019-01-30 18:43:07', '2019-02-16 02:37:58', '2019-01-30 18:43:07'),
(11, 'Mia Hey', 'Tavares Uhu', 'mia@mia.com', '$2y$10$X0FUTMvs7MH0LiU4ZIHfxenJSEPg8wG2VnjYBfWp3cQe37UuNEPh6', '1234567891', '111 Davisville', 1, 0, '2019-02-02 04:43:45', '2019-02-12 22:51:03', '2019-02-02 04:43:45'),
(12, 'Homer', 'Simpson', 'homer@homer.com', '$2y$10$5ogAvM6lywnDqpR23jJE9OqFw0LkGx7qfkDC2EGrUxLKTAH2Mj7yu', '7654321789', '678, Springfield', 1, 0, '2019-02-12 17:55:08', '2019-02-12 17:55:08', '2019-02-12 17:55:08'),
(16, 'Dolacy', 'Moreno', 'dolacy@dolacy.com', '$2y$10$KK2ct9kHd2Q2z6JaJPNtsOZ1bpzUDx0uCSeUh2SbpLSgMJh67o1EW', '1111111111', 'kjlakjda', 1, 0, '2019-02-16 02:52:19', '2019-02-16 02:52:19', '2019-02-16 02:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users_online`
--

DROP TABLE IF EXISTS `tb_users_online`;
CREATE TABLE IF NOT EXISTS `tb_users_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users_online`
--

INSERT INTO `tb_users_online` (`id`, `idTest`, `session`, `time`) VALUES
(5, 8, 'foghvlf5jpt3bbtvdp97j8lof2', 1550005094),
(6, 1, 'pfsp74f6aqcr4f77nivinc6703', 1550011963),
(7, 8, 'pfsp74f6aqcr4f77nivinc6703', 1550294526),
(8, 6, 'tu93pdmqe8btjgev7bhhmn85a1', 1550031551),
(9, 8, 'tu93pdmqe8btjgev7bhhmn85a1', 1550300042),
(10, 1, 'tu93pdmqe8btjgev7bhhmn85a1', 1550293974);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
