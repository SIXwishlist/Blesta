<?php
// Ticket Auto Refresh Time in seconds, default 10 seconds
Configure::set("SupportManagerpro.auto_refresh", "30");

// Dates
Configure::set("SupportManagerpro.time_format", "H:i:s");
Configure::set("SupportManagerpro.reply_date_format", "M j Y g:i A");

// Summary truncate length (max number of words)
Configure::set("SupportManagerpro.summary_truncate_length", 40);
// Default summary if blank
Configure::set("SupportManagerpro.summary_default", "N/A");

// Ticket number code length in number of digits. In case of conflicts (duplicate ticket codes) because of a large number of tickets, increase this number.
Configure::set("SupportManagerpro.ticket_code_length", 7);

// The maximum number of popular Knowledgebase articles to show
Configure::set("SupportManagerpro.max_kb_popular_articles", 5);
// The max number of characters in an article title to set in the URI, separated on words
Configure::set("SupportManagerpro.max_chars_article_title_uri", 50);

// Emails
Configure::set("SupportManagerpro.install.emails", array(
	array(
		'action' => "SupportManagerpro.ticket_received",
		'type' => "client",
		'plugin_dir' => "support_managerpro",
		'tags' => "{ticket},{ticket_hash_code}",
		'from' => "support@mydomain.com",
		'from_name' => "Support",
		'subject' => "We have received your ticket",
		'text' => "We have received your request and someone will be looking at it shortly.",
		'html' => "<p>We have received your request and someone will be looking at it shortly.</p>"
	),
	array(
		'action' => "SupportManagerpro.ticket_updated",
		'type' => "client",
		'plugin_dir' => "support_managerpro",
		'tags' => "{ticket},{update_ticket_url},{ticket_hash_code}",
		'from' => "support@mydomain.com",
		'from_name' => "Support",
		'subject' => "Update to Ticket {ticket_hash_code}",
		'text' => "{ticket.details}


--

To reply to this ticket, be sure to email {ticket.department_email} from the address we sent this notice to. You may also update the ticket in our support area at {update_ticket_url}.",
		'html' => "<p>
	{ticket.details_html}</p>
<p>
	&nbsp;</p>
<p>
	--</p>
<p>
	To reply to this ticket, be sure to email <a href=\"mailto:{ticket.department_email}\">{ticket.department_email}</a> from the address we sent this notice to. You may also update the ticket in our support area at <a href=\"http://{update_ticket_url}\">{update_ticket_url}</a>.</p>
"
	),
	array(
		'action' => "SupportManagerpro.ticket_bounce",
		'type' => "client",
		'plugin_dir' => "support_managerpro",
		'tags' => "",
		'from' => "support@mydomain.com",
		'from_name' => "Support",
		'subject' => "Support Request Failed",
		'text' => "Our system received your email, but was unable to process it for one of the following reasons..

1. The email address you sent the message from does not belong to any of our clients and this department only allows existing clients to open tickets.

2. You replied to a ticket notice, and we are unable to determine what ticket number you are responding to.

3. The department you emailed no longer exists.",
		'html' => "<p>
	Our system received your email, but was unable to process it for one of the following reasons..</p>
<p>
	1. The email address you sent the message from does not belong to any of our clients and this department only allows existing clients to open tickets.</p>
<p>
	2. You replied to a ticket notice, and we are unable to determine what ticket number you are responding to.</p>
<p>
	3. The department you emailed no longer exists.</p>
"
	),
	array(
		'action' => "SupportManagerpro.staff_ticket_updated",
		'type' => "staff",
		'plugin_dir' => "support_managerpro",
		'tags' => "{ticket},{ticket_hash_code}",
		'from' => "support@mydomain.com",
		'from_name' => "Support",
		'subject' => "Update to Ticket {ticket_hash_code}",
		'text' => "{ticket.details}

--

Ticket #: {ticket.code}

Status: {ticket.status_language}

Priority: {ticket.priority_language}

Department: {ticket.department_name}

--

To reply to this ticket, be sure to email {ticket.department_email} from the address we sent this notice to, or you may do so from the Staff interface.",
		'html' => "<p>
	{ticket.details_html}</p>
<p>
	--</p>
<p>
	Ticket #: {ticket.code}</p>
<p>
	Status: {ticket.status_language}</p>
<p>
	Priority: {ticket.priority_language}</p>
<p>
	Department: {ticket.department_name}</p>
<p>
	--</p>
<p>
	To reply to this ticket, be sure to email <a href=\"mailto:{ticket.department_email}\">{ticket.department_email}</a> from the address we sent this notice to, or you may do so from the Staff interface.</p>
"
	),
	array(
		'action' => "SupportManagerpro.staff_ticket_updated_mobile",
		'type' => "staff",
		'plugin_dir' => "support_managerpro",
		'tags' => "{ticket},{ticket_hash_code}",
		'from' => "support@mydomain.com",
		'from_name' => "Support",
		'subject' => "Ticket {ticket_hash_code}",
		'text' => "{ticket.details}

--

Ticket #: {ticket.code} | Status: {ticket.status_language} | Priority: {ticket.priority_language} | Department: {ticket.department_name}
",
		'html' => "<p>
	{ticket.details_html}</p>
<p>
	--</p>
<p>
	Ticket #: {ticket.code} | Status: {ticket.status_language} | Priority: {ticket.priority_language} | Department: {ticket.department_name}</p>
<p>
	&nbsp;</p>
"
	),
	array(
		'action' => "SupportManagerpro.staff_ticket_assigned",
		'type' => "staff",
		'plugin_dir' => "support_managerpro",
		'tags' => "{ticket},{staff.first_name},{staff.last_name}",
		'from' => "support@mydomain.com",
		'from_name' => "Support",
		'subject' => "Ticket #{ticket.code} has been assigned to you",
		'text' => "{staff.first_name},

A ticket has been assigned to you.

--

Ticket #: {ticket.code} | Status: {ticket.status_language} | Priority: {ticket.priority_language} | Department: {ticket.department_name}
",
		'html' => "<p>{staff.first_name},</p>
<p>A ticket has been assigned to you.</p>
<p>--</p>
<p>Ticket #: {ticket.code} | Status: {ticket.status_language} | Priority: {ticket.priority_language} | Department: {ticket.department_name}</p>
"
	)
));


// Permissions
Configure::set("SupportManagerpro.install.permissions", array(
	array(
		'name' => "SupportManagerproPlugin.permission.admin_main",
		'level' => "staff",
		'alias' => "support_managerpro.admin_main",
		'permissions' => array(
			array(
				'name' => "SupportManagerproPlugin.permission.admin_tickets",
				'alias' => "support_managerpro.admin_tickets",
				'action' => "*"
			),
			array(
				'name' => "SupportManagerproPlugin.permission.admin_tickets_client",
				'alias' => "support_managerpro.admin_tickets",
				'action' => "client"
			),
			array(
				'name' => "SupportManagerproPlugin.permission.admin_departments",
				'alias' => "support_managerpro.admin_departments",
				'action' => "*"
			),
			array(
				'name' => "SupportManagerproPlugin.permission.admin_responses",
				'alias' => "support_managerpro.admin_responses",
				'action' => "*"
			),
			array(
				'name' => "SupportManagerproPlugin.permission.admin_staff",
				'alias' => "support_managerpro.admin_staff",
				'action' => "*"
			),
			array(
				'name' => "SupportManagerproPlugin.permission.admin_knowledgebase",
				'alias' => "support_managerpro.admin_knowledgebase",
				'action' => "*"                
			)
		)
	)
));
?>