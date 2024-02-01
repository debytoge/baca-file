import whois

def domain_info(domain_name, timeout=10, verbose=False):
    try:
        domain = whois.whois(domain_name, timeout=timeout, slow_down=verbose)
        result = {
            "domain_name": domain_name,
            "expiration_date": str(domain.expiration_date),
            "nameservers": domain.name_servers
        }
        return result
    except whois.parser.PywhoisError as e:
        if verbose:
            print(f"Error: {e}")
        return None

def process_domains_from_file(file_name, timeout=10, verbose=False):
    results = []
    try:
        with open(file_name, 'r') as file:
            for line in file:
                domain_name = line.strip()
                domain_data = domain_info(domain_name, timeout=timeout, verbose=verbose)
                if domain_data:
                    results.append(domain_data)
    except FileNotFoundError:
        print(f"File '{file_name}' not found")
    return results

def save_results_to_file(results, file_name):
    with open(file_name, 'a') as file:
        for result in results:
            file.write(f"Domain Name: {result['domain_name']}\n")
            file.write(f"Expiration Date: {result['expiration_date']}\n")
            file.write(f"Name Servers: {', '.join(result['nameservers'])}\n")
            file.write("\n")

file_name = "domain.txt"
result_file_name = "result.txt"

domain_results = process_domains_from_file(file_name, timeout=10, verbose=True)
save_results_to_file(domain_results, result_file_name)
